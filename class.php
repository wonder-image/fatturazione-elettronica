<?php

    class Fattura {

        public const TIPO_DOCUMENTO = "TD01";
        public const VALUTA = "EUR";

        public const FORMATO_TRASMISSIONE = 'FPR12';
        public const XMLNS_DS = 'http://www.w3.org/2000/09/xmldsig#';
        public const XMLNS_P = 'http://ivaservizi.agenziaentrate.gov.it/docs/xsd/fatture/v1.2';
        public const XMLNS_XSI = 'http://www.w3.org/2001/XMLSchema-instance';
        public const XSI_SCHEMA = 'http://ivaservizi.agenziaentrate.gov.it/docs/xsd/fatture/v1.2 http://www.fatturapa.gov.it/export/fatturazione/sdi/fatturapa/v1.2/Schema_del_file_xml_FatturaPA_versione_1.2.xsd';

        public const ID_PAESE = "IT";
        public const PROGRESSIVO_INVIO = 1;
        public const CODICE_DESTINATARIO = "0000000";

        public $default;
        public $file;
        public $header;
        public $body;

        public function __construct($ProgressivoInvio = self::PROGRESSIVO_INVIO, $CodiceDestinatario = self::CODICE_DESTINATARIO){

            $this->file = [];
            $this->file['FatturaElettronica'] = [];
            $this->file['FatturaElettronica']['attributes'] = [
                "versione" => self::FORMATO_TRASMISSIONE,
                "xmlns:ds" => self::XMLNS_DS,
                "xmlns:p" => self::XMLNS_P,
                "xmlns:xsi" => self::XMLNS_XSI,
                "xsi:schemaLocation"=> self::XSI_SCHEMA
            ];

            $this->file['FatturaElettronica']['child'] = [];
            
            $this->header = [];
            $this->body = [];

            $this->default['TipoDocumento'] = self::TIPO_DOCUMENTO;
            $this->default['Divisa'] = self::VALUTA;
            $this->default['Data'] = date("Y-m-d");
            
            $this->default['IdPaese'] = self::ID_PAESE;
            $this->default['FormatoTrasmissione'] = self::FORMATO_TRASMISSIONE;
            $this->default['ProgressivoInvio'] = $ProgressivoInvio;
            $this->default['CodiceDestinatario'] = $CodiceDestinatario;
            $this->default['NumeroLinea'] = 1;

        }

        /**  @param string $IdPaese Sigla ISO 3166-1 alpha-2 code */ 
        public function IdPaese($IdPaese = self::ID_PAESE) { $this->default['IdPaese'] = strtoupper($IdPaese); }

        /**  @param string $codice Alfanumerico Max 10 caratteri */ 
        public function ProgressivoInvio($codice = self::PROGRESSIVO_INVIO) { $this->default['ProgressivoInvio'] = $codice; }

        /**  @param string $codiceTrasmissione FPA12 | FPR12 */ 
        public function FormatoTrasmissione($FormatoTrasmissione = self::FORMATO_TRASMISSIONE) { $this->default['FormatoTrasmissione'] = strtoupper($FormatoTrasmissione); }
        
        public function CodiceDestinatario($CodiceDestinatario = self::CODICE_DESTINATARIO) { $this->default['CodiceDestinatario'] = strtoupper($CodiceDestinatario); }

        /** @param string $Valuta ISO 4217 alpha-3:2001 */
        public function Valuta($Valuta = self::VALUTA) { $this->default['Divisa'] = strtoupper($Valuta); }

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

            public function DatiTrasmissione($IdCodice, $CodiceDestinatario = '', $PECDestinatario = '', $Telefono = '', $Email = '') {

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

            public function DatiBeniServizi() {

                $this->body['DatiBeniServizi'] = [];
                $this->body['DatiBeniServizi']['DettaglioLinee'] = [];
                $this->body['DatiBeniServizi']['DettaglioLinee']['array'] = true;
                $this->body['DatiBeniServizi']['DettaglioLinee']['child'] = [];

            }

            public function Sconto($Importo, $Simbolo = "valuta") {

                $ScontoMaggiorazione = [];

                $ScontoMaggiorazione['Tipo'] = 'SC';

                $Importo = number_format($Importo, 2, '.', '');

                if ($Simbolo == 'valuta') {
                    $ScontoMaggiorazione['Importo'] = $Importo;
                } elseif ($Simbolo == 'percentuale') {
                    $ScontoMaggiorazione['Percentuale'] = $Importo;
                }

                return $ScontoMaggiorazione;

            }

            public function Maggiorazione($Importo, $Simbolo = "valuta") {

                $ScontoMaggiorazione = [];

                $ScontoMaggiorazione['Tipo'] = 'MG';

                $Importo = number_format($Importo, 2, '.', '');

                if ($Simbolo == 'valuta') {
                    $ScontoMaggiorazione['Importo'] = $Importo;
                } elseif ($Simbolo == 'percentuale') {
                    $ScontoMaggiorazione['Percentuale'] = $Importo;
                }

                return $ScontoMaggiorazione;

            }

            public function Linea($Descrizione, $AliquotaIVA, $Natura, $Quantita, $PrezzoUnitario, $PrezzoTotale, $ScontoMaggiorazione = []) {

                $Linea = [];

                $Linea['NumeroLinea'] = $this->default['NumeroLinea'];
                $Linea['Descrizione'] = $Descrizione;
                $Linea['AliquotaIVA'] = number_format($AliquotaIVA, 2, '.', '');

                if (!empty($Natura)) { $Linea['Natura'] = $Natura; }

                $Linea['Quantita'] = number_format($Quantita, 2, '.', '');
                $Linea['PrezzoUnitario'] = number_format($PrezzoUnitario, 2, '.', '');
                $Linea['PrezzoTotale'] = number_format($PrezzoTotale, 2, '.', '');

                if (!empty($ScontoMaggiorazione)) { $Linea['ScontoMaggiorazione'] = $ScontoMaggiorazione; }

                $this->default['NumeroLinea']++;

                array_push($this->body['DatiBeniServizi']['DettaglioLinee']['child'], $Linea);

            }

        // 

        // Esportazione
            private function arrayToXml($ARRAY, $FILENAME = null, $VERSION = "1.0", $ENCODING = "UTF-8") {

                $XML = new DOMDocument($VERSION, $ENCODING);
        
                $XML->preserveWhiteSpace = true;
                $XML->formatOutput = true;
        
                $XML = $this->createXML($XML, $ARRAY);
        
                if ($FILENAME == null) {
                    
                    return $XML->saveXML();
        
                } else {
        
                    header("Content-Type: text/xml");
                    header("Content-Disposition: attachment; filename=\"$FILENAME.xml\"");
                    header("Pragma: no-cache");
                    header("Expires: 0");
        
                    echo $XML->saveXML();
        
                }
        
            }

            private function createXml($XML, $CHILD, $PARENT = null) {

                if ($PARENT == null) {
                    $PARENT = $XML;
                }
                
                foreach ($CHILD as $NAME => $VALUE) {
                    
                    if (is_array($VALUE)) {
        
                        $elementValue = isset($VALUE['value']) ? $VALUE['value'] : "";
                        $elementAttributes = isset($VALUE['attributes']) ? $VALUE['attributes'] : "";
                        $elementChild = isset($VALUE['child']) ? $VALUE['child'] : "";
                        $elementArray = ($VALUE['array'] == true) ? true : false;
                        
                        if (!$elementArray) {
        
                            $element = $XML->createElement($NAME, $elementValue);
        
                            if (is_array($elementAttributes)) {
                                foreach ($elementAttributes as $attribute => $value) { $element->setAttribute($attribute, $value); }
                            }
        
                            $PARENT = $PARENT->appendChild($element);
        
                            if (is_array($elementChild)) {
                                foreach ($elementChild as $childName => $childValue) { 
        
                                    $child = [];
                                    $child[$childName] = $childValue;
        
                                    if (is_array($childValue)) {
                                        $XML = $this->createXml($XML, $child, $PARENT); 
                                    } else {
                                        $element = $XML->createElement($NAME, $childValue);
                                        $PARENT->appendChild($element);
                                    }
        
                                }
                            }
        
                        } else {
        
                            foreach ($elementChild as $key => $childValue) {
        
                                $child = [];
                                $child[$NAME] = $childValue;
        
                                if (is_array($childValue)) {
                                    $XML = $this->createXml($XML, $child, $PARENT); 
                                } else {
                                    $element = $XML->createElement($NAME, $childValue);
                                    $PARENT->appendChild($element);
                                }
        
                            } 
        
                        }
        
                        if (empty($elementValue) && empty($elementAttributes) && empty($elementChild)) {
                            foreach ($VALUE as $childName => $childValue) { 
        
                                $child = [];
                                $child[$childName] = $childValue;
        
                                if (is_array($childValue)) {
                                    $XML = $this->createXml($XML, $child, $PARENT); 
                                } else {
                                    $element = $XML->createElement($childName, $childValue);
                                    $PARENT->appendChild($element);
                                }
        
                            }
                        } 
        
                    } else {
        
                        $element = $XML->createElement($NAME, $VALUE);
                        $PARENT->appendChild($element);
        
                    }
                    
                }
        
                return $XML;
        
            }

            private function prettyPrint($array) {

                print("<pre>".print_r($array,true)."</pre>");

            }

            public function export($type = 'array', $action = false) {

                # $action = print | inline | download

                $this->file['FatturaElettronica']['child']['FatturaElettronicaHeader'] = $this->header;
                $this->file['FatturaElettronica']['child']['FatturaElettronicaBody'] = $this->body;

                if ($type == 'array') {

                    if ($action != false) {
                        if ($action == "inline") {
                            $this->prettyPrint($this->file);
                        }
                    } else {
                        return $this->file;
                    }

                } elseif ($type = 'xml') {

                    if ($action != false) {
                        if ($action == "inline") {
                            header("Content-Type: text/xml");
                            echo $this->arrayToXml($this->file);
                        } elseif ($action == "download") {
                            $this->arrayToXml($this->file, 'Fattura '.$this->default['ProgressivoInvio']);
                        }
                    } else {
                        return $this->arrayToXml($this->file);
                    }

                }

            }
        // 

    }

?>
