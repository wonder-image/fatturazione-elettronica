<?php

    class Fattura {

        public const TIPO_DOCUMENTO = "TD01";
        public const VALUTA = "EUR";

        public const VERSIONE = 'FPA12'; # Fattura privati: FPR12 - Fattura aziende: FPA12
        public const XMLNS_DS = 'http://www.w3.org/2000/09/xmldsig#';
        public const XMLNS_P = 'http://ivaservizi.agenziaentrate.gov.it/docs/xsd/fatture/v1.2';
        public const XMLNS_XSI = 'http://www.w3.org/2001/XMLSchema-instance';
        public const XSI_SCHEMA = 'http://ivaservizi.agenziaentrate.gov.it/docs/xsd/fatture/v1.2 http://www.fatturapa.gov.it/export/fatturazione/sdi/fatturapa/v1.2/Schema_del_file_xml_FatturaPA_versione_1.2.xsd';

        public const ID_PAESE = "IT";
        public const PROGRESSIVO_INVIO = 1;
        public const CODICE_DESTINATARIO = "000000";

        public $default;
        public $file;
        public $header;
        public $body;

        public function __construct($TipoDocumento = self::TIPO_DOCUMENTO, $Valuta = self::VALUTA){

            $this->file = [];
            $this->file['FatturaElettronica'] = [];
            $this->file['FatturaElettronica']['attributes'] = [
                "versione" => self::VERSIONE,
                "xmlns:ds" => self::XMLNS_DS,
                "xmlns:p" => self::XMLNS_P,
                "xmlns:xsi" => self::XMLNS_XSI,
                "xsi:schemaLocation"=> self::XSI_SCHEMA
            ];

            $this->file['FatturaElettronica']['child'] = [];
            
            $this->header = [];
            $this->body = [];

            $this->default['TipoDocumento'] = $TipoDocumento;
            $this->default['Divisa'] = $Valuta;
            $this->default['Data'] = date("Y-m-d");
            
            $this->default['IdPaese'] = self::ID_PAESE;
            $this->default['FormatoTrasmissione'] = self::VERSIONE;
            $this->default['ProgressivoInvio'] = self::PROGRESSIVO_INVIO;
            $this->default['CodiceDestinatario'] = self::CODICE_DESTINATARIO;

        }

        /**  @param string $IdPaese Sigla ISO 3166-1 alpha-2 code */ 
        public function IdPaese($IdPaese = "IT") { $this->default['IdPaese'] = strtoupper($IdPaese); }

        /**  @param string $codice Alfanumerico Max 10 caratteri */ 
        public function ProgressivoInvio($codice = self::PROGRESSIVO_INVIO) { $this->default['ProgressivoInvio'] = $codice; }

        /**  @param string $codiceTrasmissione FPA12 | FPR12 */ 
        public function FormatoTrasmissione($codiceTrasmissione = self::VERSIONE) { $this->default['FormatoTrasmissione'] = strtoupper($codiceTrasmissione); }

        // FATTURAELETTRONICAHEADER

            public function Contatti($Telefono, $Fax, $Email) {
                
                $Contatti = [];
                
                if (!empty($Telefono)) { $Contatti['Telefono'] = $Telefono; }
                if (!empty($Fax)) { $Contatti['Fax'] = $Fax; }
                if (!empty($Email)) { $Contatti['Email'] = $Email; }
                
                return $Contatti;

            }

            /**
             * Indirizzo
             *
             * @param  mixed $Via Alfanumerico Max 60 caratteri
             * @param  mixed $NumeroCivico Alfanumerico Max 8 caratteri
             * @param  int $CAP Numerico Max 8 caratteri
             * @param  mixed $Comune Alfanumerico Max 60 caratteri
             * @param  mixed $Provincia Sigla Alfanumerico Max 2 caratteri
             * @param  mixed $Nazione Sigla ISO 3166-1 alpha-2 code
             * @return void
             */
            public function Indirizzo($Via, $NumeroCivico, $CAP, $Comune, $Provincia, $Nazione) {
                
                $Indirizzo = [];

                $Indirizzo['Indirizzo'] = $Via;
                $Indirizzo['NumeroCivico'] = $NumeroCivico;
                $Indirizzo['CAP'] = $CAP;
                $Indirizzo['Comune'] = $Comune;
                $Indirizzo['Provincia'] = $Provincia;
                $Indirizzo['Nazione'] = $Nazione;
                
                return $Indirizzo;

            }
        
            /**
             * IscrizioneREA
             *
             * @param  mixed $Ufficio Alfanumerico Max 2 caratteri
             * @param  mixed $NumeroREA Alfanumerico Max 20 caratteri
             * @param  mixed $CapitaleSociale Numerico number_format($CapitaleSociale, 2, '.', '') Tra 4-15 caratteri
             * @param  bool $SocioUnico
             * @param  bool $StatoLiquidazione
             * @return void
             */
            public function IscrizioneREA($Ufficio, $NumeroREA, $CapitaleSociale, $SocioUnico = false, $StatoLiquidazione = false) {

                $REA = [];

                $REA['Ufficio'] = $Ufficio;
                $REA['NumeroREA'] = $NumeroREA;
                $REA['CapitaleSociale'] = $CapitaleSociale;
                $REA['SocioUnico'] = ($SocioUnico == true) ? 'SU' : 'SE';
                $REA['StatoLiquidazione'] = ($StatoLiquidazione == true) ? 'LS' : 'LN';
                
                return $REA;

            }

            public function IscrizioneAlbo($Nome, $Provincia, $NumeroIscrizione, $Descrizione = '') {
                
                $Albo = [];

                $Albo['AlboProfessionale'] = $Nome;
                $Albo['ProvinciaAlbo'] = $Provincia;
                $Albo['NumeroIscrizioneAlbo'] = $NumeroIscrizione;

                if (!empty($Descrizione)) { $Albo['DescrizioneAlbo'] = $Descrizione; }
                
                return $Albo;

            } 
            
            public function AnagraficaAzienda($Denominazione, $CodEORI = null) {
                
                $Anagrafica = [];
                $Anagrafica['Denominazione'] = $Denominazione;

                if ($CodEORI != null) { $Anagrafica['CodEORI'] = $CodEORI; }

                
                return $Anagrafica;

            }

            public function AnagraficaPrivato($Nome, $Cognome, $Titolo = null, $CodEORI = null) {
                
                $Anagrafica = [];

                if ($CodEORI != null) { $Anagrafica['CodEORI'] = $CodEORI; }

                $Anagrafica['Nome'] = $Nome;
                $Anagrafica['Cognome'] = $Cognome;

                if ($Titolo != null) { $Anagrafica['Titolo'] = $Titolo; }
                
                return $Anagrafica;

            }
            
            public function IdTrasmittente($IdCodice, $IdPaese = null) {

                $IdTrasmittente = [];

                $IdTrasmittente['IdPaese'] = $IdPaese == null ? $this->default['IdPaese'] : $IdPaese;
                $IdTrasmittente['IdCodice'] = $IdCodice;
                
                return $IdTrasmittente;
                
            }

            public function IdFiscaleIVA($IdCodice, $IdPaese = null) {

                $IdFiscaleIVA['IdFiscaleIVA'] = [];
                $IdFiscaleIVA['IdFiscaleIVA']['IdPaese'] = $IdPaese == null ? $this->default['IdPaese'] : $IdPaese;
                $IdFiscaleIVA['IdFiscaleIVA']['IdCodice'] = $IdCodice;
                
                return $IdFiscaleIVA;
                
            }

            public function DatiAnagrafici($DatiFiscali, $Anagrafica, $RegimeFiscale, $CodiceFiscale = null, $Albo = []) {

                $DatiAnagrafici = [];
                
                $DatiAnagrafici = array_merge($DatiAnagrafici, $DatiFiscali);
                if (!empty($CodiceFiscale)) { $DatiAnagrafici['CodiceFiscale'] = $CodiceFiscale; }
                $DatiAnagrafici['Anagrafica'] = $Anagrafica;

                if (!empty($Albo)) { $DatiAnagrafici = array_merge($DatiAnagrafici, $Albo); }
                if ($RegimeFiscale != null) { $DatiAnagrafici['RegimeFiscale'] = $RegimeFiscale; }

                return $DatiAnagrafici;

            }

            public function DatiTrasmissione($IdCodice, $CodiceDestinatario, $PECDestinatario = '', $Telefono = '', $Email = '') {

                $DatiTrasmissione = [];
                $DatiTrasmissione['IdTrasmittente'] = $this->IdTrasmittente($IdCodice);
                $DatiTrasmissione['ProgressivoInvio'] = $this->default['ProgressivoInvio'];
                $DatiTrasmissione['FormatoTrasmissione'] = $this->default['FormatoTrasmissione'];

                $DatiTrasmissione['CodiceDestinatario'] =  empty($CodiceDestinatario) ? $this->default['CodiceDestinatario'] : $CodiceDestinatario;
                
                if (!empty($PECDestinatario)) { $DatiTrasmissione['PECDestinatario'] = $PECDestinatario; }


                if (!empty($Telefono) || !empty($Email)) {

                    $DatiTrasmissione['ContattiTrasmittente'] = [];

                    if (!empty($Telefono)) { $DatiTrasmissione['ContattiTrasmittente']['Telefono'] = $Telefono; }
                    if (!empty($Email)) { $DatiTrasmissione['ContattiTrasmittente']['Email'] = $Email; }

                }

                $this->header['DatiTrasmissione'] = $DatiTrasmissione;

            }

            public function CedentePrestatore($DatiAnagrafici, $SedeLegale, $Contatti = '', $RiferimentoAmministrativo = '', $StabileOrganizzazione = '', $IscrizioneRea = '') {

                $CedentePrestatore = [];
                $CedentePrestatore['DatiAnagrafici'] = $DatiAnagrafici;
                $CedentePrestatore['Sede'] = $SedeLegale;

                if (!empty($Contatti)) { $CedentePrestatore['Contatti'] = $Contatti; }
                if (!empty($RiferimentoAmministrativo)) { $CedentePrestatore['RiferimentoAmministrativo'] = $RiferimentoAmministrativo; }
                if (!empty($StabileOrganizzazione)) { $CedentePrestatore['StabileOrganizzazione'] = $StabileOrganizzazione; }
                if (!empty($IscrizioneRea)) { $CedentePrestatore['IscrizioneRea'] = $IscrizioneRea; }
                
                $this->header['CedentePrestatore'] = $CedentePrestatore;

            }

            public function RappresentanteFiscale($DatiAnagrafici) {

                $RappresentanteFiscale = [];
                $RappresentanteFiscale['DatiAnagrafici'] = $DatiAnagrafici;

                return $RappresentanteFiscale;

            }

            public function CessionarioCommittente($DatiAnagrafici, $SedeLegale, $RappresentanteFiscale = '', $StabileOrganizzazione = '') {

                $CessionarioCommittente = [];
                $CessionarioCommittente['DatiAnagrafici'] = $DatiAnagrafici;
                $CessionarioCommittente['Sede'] = $SedeLegale;

                if (!empty($StabileOrganizzazione)) { $CessionarioCommittente['StabileOrganizzazione'] = $StabileOrganizzazione; }
                if (!empty($RappresentanteFiscale)) { $CessionarioCommittente['RappresentanteFiscale'] =$RappresentanteFiscale; }

                $this->header['CessionarioCommittente'] = $CessionarioCommittente;

            }

            public function TerzoIntermediarioOSoggettoEmittente($DatiAnagrafici) {

                $TerzoIntermediarioOSoggettoEmittente = [];
                $TerzoIntermediarioOSoggettoEmittente['DatiAnagrafici'] = $DatiAnagrafici;

                $this->header['TerzoIntermediarioOSoggettoEmittente'] = $TerzoIntermediarioOSoggettoEmittente;

            }

        // 

        // FATTURAELETTRONICABADY
            public function DatiGenerali($DatiGeneraliDocumento) {

                $this->body['DatiGenerali'] = [];
                $this->body['DatiGenerali']['DatiGeneraliDocumento'] = $DatiGeneraliDocumento;

            }

            public function DatiGeneraliDocumento() {

                $DatiGeneraliDocumento = [];
                $DatiGeneraliDocumento['TipoDocumento'] = $this->default['TipoDocumento'];
                $DatiGeneraliDocumento['Divisa'] = $this->default['Divisa'];

                $DatiGeneraliDocumento['Data'] = $this->default['Data'];

                $DatiGeneraliDocumento['Numero'] = $this->default['ProgressivoInvio'];

                
                return $DatiGeneraliDocumento;

            }

        // 

        public function export($type = 'array', $action = false) {

            # $action = print | inline | download

            $this->file['FatturaElettronica']['child']['FatturaElettronicaHeader'] = $this->header;
            $this->file['FatturaElettronica']['child']['FatturaElettronicaBody'] = $this->body;

            if ($type == 'array') {

                if ($action != false) {
                    if ($action == "inline") {
                        prettyPrint($this->file);
                    }
                } else {
                    return $this->file;
                }

            } elseif ($type = 'xml') {

                $XML = arrayToXml($this->file);

                if ($action != false) {
                    if ($action == "inline") {
                        header("Content-Type: text/xml");
                        echo $XML;
                    } elseif ($action == "download") {
                        # Scarica file
                    }
                } else {
                    return $XML;
                }

            }

        }

    }

?>
