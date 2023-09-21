# FATTURAZIONE ELETTRONICA


## LINK UTILI

- [Specifiche compilazione](https://www.fatturapa.gov.it/export/documenti/Specifiche_tecniche_del_formato_FatturaPA_V1.3.2.pdf)
- [Verificare fattura](https://www.fatturacheck.it/)


## FORMATO TRASMISSIONE
| Codice | Fatture Verso |
| :---: | :--- |
| `FPR12` | Privati |
| `FPA12` | Pubblia Amministrazione |


## TIPOLOGIA DOCUMENTO
| Codice | Documento |
| :---: | :--- |
| `TD01` | Fattura |
| `TD02` | Acconto/Anticipo su fattura |
| `TD03` | Acconto/Anticipo su parcella |
| `TD04` | Nota di Credito |
| `TD05` | Nota di Debito |
| `TD06` | Parcella |
| `TD16` | Integrazione fattura reverse charge interno |
| `TD17` | Integrazione/autofattura per acquisto servizi dall’estero |
| `TD18` | Integrazione per acquisto di beni intracomunitari |
| `TD19` | Integrazione/autofattura per acquisto di beni ex art.17 c.2 DPR 633/72 |
| `TD20` | Autofattura per regolarizzazione e integrazione delle fatture (art.6 c.8 d.lgs. 471/97 o art.46 c.5 D.L. 331/93) |
| `TD21` | Autofattura per splafonamento |
| `TD22` | Estrazione beni da Deposito IVA |
| `TD23` | Estrazione beni da Deposito IVA con versamento dell’IVA |
| `TD24` | Fattura differita di cui all’art.21, comma 4, lett. a) |
| `TD25` | Fattura differita di cui all’art.21, comma 4, terzo periodo lett. b) |
| `TD26` | Cessione di beni ammortizzabili e per passaggi interni (ex art.36 DPR 633/72) |
| `TD27` | Fattura per autoconsumo o per cessioni gratuite senza rivalsa |
| `TD28` | Acquisti da San Marino con IVA (fattura cartacea) |


## REGIME FISCALE
| Codice | Regime Fiscale |
| :---: | :--- |
| `RF01` | Ordinario |
| `RF02` | Contribuenti minimi (art. 1, c.96-117, L. 244/2007) |
| `RF04` | Agricoltura e attività connesse e pesca (artt. 34 e 34-bis, D.P.R. 633/1972); |
| `RF05` | Vendita sali e tabacchi (art. 74, c.1, D.P.R. 633/1972) |
| `RF06` | Commercio dei fiammiferi (art. 74, c.1, D.P.R. 633/1972) |
| `RF07` | Editoria (art. 74, c.1, D.P.R. 633/1972) |
| `RF08` | Gestione di servizi di telefonia pubblica (art. 74, c.1, D.P.R. 633/1972) |
| `RF09` | Rivendita di documenti di trasporto pubblico e di sosta (art. 74, c.1, D.P.R. 633/1972); |
| `RF10` | Intrattenimenti, giochi e altre attività di cui alla tariffa allegata al D.P.R. n. 640/72 (art. 74, c.6, D.P.R. 633/1972) |
| `RF11` | Agenzie di viaggi e turismo (art. 74-ter, D.P.R. 633/1972) |
| `RF12` | Agriturismo (art. 5, c.2, L. 413/1991) |
| `RF13` | Vendite a domicilio (art. 25-bis, c.6, D.P.R. 600/1973) |
| `RF14` | Rivendita di beni usati, di oggetti d’arte, d’antiquariato o da collezione (art. 36, D.L. 41/1995) |
| `RF15` | Agenzie di vendite all’asta di oggetti d’arte, antiquariato o da collezione (art. 40-bis, D.L. 41/1995) |
| `RF16` | IVA per cassa P.A. (art. 6, c.5, D.P.R. 633/1972) |
| `RF17` | IVA per cassa (art. 32-bis, D.L. 83/2012) |
| `RF18` | Altro |
| `RF19` | Forfettario (art.1, c. 54-89, L. 190/2014) |


## NATURA PRODOTTI
| Codice | Natura |
| :---: | :--- |
| `N1` | Escluse ex art.15 |
| `N2` | Non soggette (non più valido dal 1 Gen 2021) |
| `N2.1` | Non soggette ad IVA ai sensi degli artt. da 7 a 7-septies del DPR 633/72 |
| `N2.2` | Non soggette - altri casi |
| `N3` | Non imponibili (non più valido dal 1 Gen 2021) |
| `N3.1` | Non imponibili - esportazioni |
| `N3.2` | Non imponibili - cessioni intracomunitarie |
| `N3.3` | Non imponibili - cessioni verso San Marino |
| `N3.4` | Non imponibili - operazioni assimilate alle cessioni all’esportazione |
| `N3.5` | Non imponibili - a seguito di dichiarazioni d’intento |
| `N3.6` | Non imponibili - altre operazioni che non concorrono alla formazione del plafond |
| `N4` | Esenti |
| `N5` | Regime del margine / IVA non esposta in fattura |
| `N6` | Inversione contabile (per le operazioni in reverse charge ovvero nei casi di autofatturazione per acquisti extra UE di servizi ovvero per importazioni di beni nei soli casi previsti) (non più valido dal 1 Gen 2021) |
| `N6.1` | Inversione contabile - cessione di rottami e altri materiali di recupero |
| `N6.2` | Inversione contabile - cessione di oro e argento puro |
| `N6.3` | Inversione contabile - subappalto nel settore edile |
| `N6.4` | Inversione contabile - cessione di fabbricati |
| `N6.5` | Inversione contabile - cessione di telefoni cellular |
| `N6.6` | Inversione contabile - cessione di prodotti elettronici |
| `N6.7` | Inversione contabile - prestazioni comparto edile e settori connessi |
| `N6.8` | Inversione contabile - operazioni settore energetico |
| `N6.9` | Inversione contabile - altri casi |
| `N7` | IVA assolta in altro stato UE (prestazione di servizi di telecomunicazioni, tele-radiodiffusione ed elettronici ex art. 7-octies, comma 1 lett. a, b, art. 74-sexies DPR 633/72) |


## ESIGIBILITA IVA
| Codice | Esigibilità |
| :---: | :--- |
| `I` | Iva ad esigibilità immediata |
| `D` | Iva ad esigibilità differita |
| `S` | Scissione dei pagamenti |


## CONDIZIONI PAGAMENTO
| Codice | Pagamento |
| :---: | :--- |
| `TP01` | Pagamento a rate |
| `TP02` | Pagamento completo |
| `TP03` | Anticipo |


## MODALITÀ PAGAMENTO
| Codice | Pagamento |
| :---: | :--- |
| `MP01` | Contanti |
| `MP02` | Assegno |
| `MP03` | Assegno circolare |
| `MP04` | Contanti presso Tesoriera |
| `MP05` | Bonifico |
| `MP06` | Valigia cambiario |
| `MP07` | Bollettino cambiario |
| `MP08` | Carta di Pagamento |
| `MP09` | RID |
| `MP10` | RID utenze |
| `MP11` | RID veloce |
| `MP12` | Riba |
| `MP13` | MAV |
| `MP14` | Quietanza erario stato |
| `MP15` | Giroconto su conti di contabilità speciale |
| `MP16` | Domiciliazione bancaria |
| `MP17` | Domiciliazione postale |
| `MP18` | Bollettino di c/c postale |
| `MP19` | SEPA Direct Debit |
| `MP20` | SEPA Direct Debit CORE |
| `MP21` | SEPA Direct Debit B2B |
| `MP22` | Trattenuta su somme già riscosse |
| `MP23` | PagoPA |

## LICENZA

[MIT](https://github.com/wonder-image/fatturazione-elettronica/blob/main/LICENSE)

