import socket as soc
import pathlib


PATH = pathlib.Path(__file__).parent.resolve()

# Ascolto richieste per l'ip
HOST = soc.gethostname()
PORT = 5005


# Inizializzazione file fIpGuests (ip guests)
with open("util/ipGuests", "w+") as fIpGuests:
    fIpGuests.write("")

with soc.socket(soc.AF_INET, soc.SOCK_DGRAM) as socket:

    # Se non si riesce ad aprire una socket sul PORT vuol dire
    # che il server probabilmente è già in esecuzione. Questo
    # programma viene chiuso. 
    try:
        socket.bind(("0.0.0.0", PORT))
    except Exception as e:
        quit()


    print("Il server e' in esecuzione!")

    while(True):

        # Attesa ricezione messaggio
        msg, address = socket.recvfrom(1024)
        socket.sendto(str.encode(""), address)

        # Registrazione guest
        name = msg.decode("utf-8")
        ip = address[0]

        # Lettura per controllare che il guest non è già registrato
        # Se non è già registrato, si appende una nuova riga
        # Altrimenti si aggiorna l'ip
        try:
            with open("util/ipGuests", "r") as fIpGuests:
                fileString = fIpGuests.readlines()
        
        # Gestione eccezione se il file non esiste
        except:
            fileString = []


        for line in fileString:
            
            lineSplit = line.split('|')
            
            if lineSplit[0] == name:
                line = f"{name}|{ip}\n"
                break

        else:
            fileString.append(f"{name}|{ip}\n") 

        # Scrittura del file aggionrato
        with open("util/ipGuests", "w+") as fIpGuests:
            fIpGuests.writelines(fileString)

