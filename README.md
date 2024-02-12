# Struttura repository

Il repository è costituito dalle seguenti cartelle:
- **diagrammi**: sono presenti tutti i diagrammi realizzati per la documentazione.
- **dcareHTML**: root document del web server. All'interno sono implementati i livelli _data access_, _business logic_ e _presentation_ della web application.
- **src**: sono presenti gli script python degli eseguibili per l'avvio del client e del server.
- **util**: sono presenti alcuni file di utilità per l'applicazione:
  - config.ini: file di configurazione per il client.
  - createDatabase.sql: file di configurazione del database per la creazione delle tabelle.
  - ipGuest: file utilizzato dal server per la memorizzazione dei guest attivi nella rete locale.
- **testBlackbox**: codici sorgenti per i test black box.
