import socket as soc

with soc.socket(soc.AF_INET, soc.SOCK_DGRAM) as socket:
    socket.sendto(str.encode("16|scheda_odontoiatrica"), ("192.168.1.9", 5007))

