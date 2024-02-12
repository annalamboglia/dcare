import asyncio
import webbrowser
import os
import socket as soc
from gevent import config
import tornado.httpserver
import tornado.websocket
import tornado.ioloop
import tornado.web
import threading
import configparser

# Lettura file di configurazione
config = configparser.ConfigParser()
config.read("./util/config.ini")

IPBROADCAST = config.get("CONFIG", "ipBroadcast")
NOMEGUEST = config.get("CONFIG", "nomeStudio")
PATHBROWSER = config.get("CONFIG", "pathBrowser")

# PORTO PER LA REGISTRAZIONE AL SERVER (5005)
PORT = 5005

# PORTO PER LA COMUNICAZIONE LOCALE WEBSOCKET (5006)
LOCAL_PORT = 5006

# PORTO PER LA COMUNICAZIONE SERVER-GUEST (5007)
RECV_PORT = 5007

# Creaazione server Web Socket
class WebSocket(tornado.websocket.WebSocketHandler):

    client = None

    def open(self):
        WebSocket.client = self

    def on_close(self):
        WebSocket.client = None
        
    @classmethod
    def send_message(cls, msg):

        if cls.client != None:
            cls.client.write_message(msg)
 

    def check_origin(self, origin):
        return True

application = tornado.web.Application([
    (r'/websocketserver', WebSocket),
])

# Task per la ricezione di notifiche
def task_rcv():

    asyncio.set_event_loop(asyncio.new_event_loop())

    with soc.socket(soc.AF_INET, soc.SOCK_DGRAM) as socket:

        socket.bind(("0.0.0.0", RECV_PORT))
    
        while(True):
            msg, address = socket.recvfrom(1024)
            msg = msg.decode("utf-8")
            WebSocket.send_message(msg)

# Task open browser
def task_open_browser():

    asyncio.set_event_loop(asyncio.new_event_loop())

    while(True):

        input("Premere il tasto invio per aprire l'applicazione\n")

        # Ricerca IP del server
        with soc.socket(soc.AF_INET, soc.SOCK_DGRAM) as socket:

            socket.settimeout(0.5)
            socket.sendto(str.encode(NOMEGUEST), (IPBROADCAST, PORT))
            try:
                msg, address = socket.recvfrom(1024)
                ip = address[0]

                # Apertura del browser sulla pagine index
                url = f"{ip}/index.php"

                if os.path.isfile(PATHBROWSER):
                    webbrowser.get(PATHBROWSER + " %s").open(url)
                else:
                    webbrowser.open(url)

            except:
                print("Impossibile collegarsi al server.\n")
 

if __name__ == "__main__":

    http_server = tornado.httpserver.HTTPServer(application)

    # Se non si riesce ad aprire una socket sul LOCAL_PORT vuol dire
    # che il client probabilmente è già in esecuzione. Questo
    # programma viene chiuso. 
    try:
        http_server.listen(LOCAL_PORT)
    except Exception as e:
        quit()
    
    # Avvio thread ricezione ed invio messaggi
    task_rcv = threading.Thread(target=task_rcv, args=[])
    task_rcv.start()
    task_browser = threading.Thread(target=task_open_browser, args=[])
    task_browser.start()
    tornado.ioloop.IOLoop.instance().start()
    task_rcv.join()
