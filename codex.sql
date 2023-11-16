-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Nov 16, 2023 alle 19:34
-- Versione del server: 8.1.0
-- Versione PHP: 8.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codex`
--

--
-- Dump dei dati per la tabella `accessoUtenti`
--

INSERT INTO `accessoUtenti` (`idAccessoUtente`, `idUtente`, `autenticato`, `ip`, `created_at`, `updated_at`) VALUES
(318, 1, 1, '127.0.0.1', '2023-11-15 16:18:30', '2023-11-15 16:18:30');

--
-- Dump dei dati per la tabella `categorie`
--

INSERT INTO `categorie` (`idCategoria`, `nome`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Azione', NULL, '2023-11-01 22:56:35', '2023-11-01 22:56:35'),
(2, 'Fantasy', NULL, '2023-11-01 22:56:35', '2023-11-01 22:56:35'),
(3, 'Commedia', NULL, '2023-11-01 22:56:35', '2023-11-01 22:56:35'),
(4, 'Horror', NULL, '2023-11-01 22:56:35', '2023-11-01 22:56:35');

--
-- Dump dei dati per la tabella `configurazioni`
--

INSERT INTO `configurazioni` (`idConfigurazione`, `chiave`, `valore`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'durataSessione', '1200000', NULL, '2023-11-01 22:56:35', '2023-11-01 22:56:35'),
(2, 'durataSfida', '300000', NULL, '2023-11-01 22:56:35', '2023-11-01 22:56:35'),
(3, 'maxLoginErrati', '100', NULL, '2023-11-01 22:56:35', '2023-11-01 22:56:35'),
(4, 'vecchiePsw', '3', NULL, '2023-11-01 22:56:35', '2023-11-01 22:56:35');

--
-- Dump dei dati per la tabella `episodi`
--

INSERT INTO `episodi` (`idEpisodio`, `titolo`, `serieTv`, `durata`, `stagione`, `episodio`, `anno`, `trama`, `trailer`, `fotoAnteprima`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Segreti', 'Dark', 60, 1, 1, '2017', 'Jonas scopre inoltre che la ragazza di cui è da tempo innamorato, Martha Nielsen, ora sta con il suo migliore amico, Bartosz Tiedemann.', NULL, NULL, NULL, '2023-11-01 22:56:35', '2023-11-01 22:56:35'),
(2, 'Bugie', 'Dark', 60, 1, 2, '2017', 'La scomparsa di Mikkel riporta i cittadini di Winden indietro nel tempo, precisamente ai fatti accaduti nel 1986', NULL, NULL, NULL, '2023-11-01 22:56:35', '2023-11-01 22:56:35'),
(3, 'Questione di chimica', 'Breaking Bad', 60, 1, 1, '2008', 'In una riserva indiana nel deserto del New Mexico, un uomo in mutande e maschera antigas guida con difficoltà un camper.', NULL, NULL, NULL, '2023-11-01 22:56:35', '2023-11-01 22:56:35'),
(4, 'Senza ritorno', 'Breaking Bad', 60, 1, 2, '2008', 'Jesse e non vedersi mai più dopo che si saranno sbarazzati dei corpi.', NULL, NULL, NULL, '2023-11-01 22:56:35', '2023-11-01 22:56:35'),
(5, 'Una lunga storia', 'How I Met Your Mother', 22, 1, 1, '2008', 'Quando il suo migliore amico Marshall si fidanza, Ted capisce che è giunto anche per lui il momento di trovare la sua anima gemella.', NULL, NULL, NULL, '2023-11-01 22:56:35', '2023-11-01 22:56:35'),
(6, 'La giraffa viola', 'How I Met Your Mother', 22, 1, 2, '2008', 'Dopo il disastro del loro primo incontro, Ted cerca disperatamente di ottenere un secondo appuntamento con Robin.', NULL, NULL, NULL, '2023-11-01 22:56:35', '2023-11-01 22:56:35');

--
-- Dump dei dati per la tabella `film`
--

INSERT INTO `film` (`idFilm`, `titolo`, `durata`, `regista`, `categoria`, `anno`, `trama`, `trailer`, `fotoAnteprima`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'The Fast and the Furious: Tokyo Drift', 86, 'Justin Lin', 'azione', '2006', 'Shaun Boswell è un ragazzo irrequieto al quale piace partecipare alle corse di auto clandestine. Finito nei guai con la giustizia, è costretto, per evitare la prigione, a raggiungere suo padre che è militare in servizio a Tokyo.', NULL, NULL, NULL, '2023-11-01 22:56:35', '2023-11-01 22:56:35'),
(2, 'Deadpool', 155, 'Fabian Nicieza', 'Avventura', '2014', 'È un eroe-antieroe noto per il suo humour, fatto di doppisensi e riferimenti a film, serie televisive, canzoni e immagini popolari. Teledipendente tanto da descrivere la propria mano destra come La mia mano CINEMAX.', NULL, NULL, NULL, '2023-11-01 22:56:35', '2023-11-01 22:56:35'),
(3, 'GHOST DOG', 84, 'Jim Jarmusch', 'Azione', '1999', 'Ghost Dog è il soprannome di un sicario, che vive solitario in una sporca terrazza del New Jersey, seguendo i precetti del Bushido, il codice di comportamento del samurai.', NULL, NULL, NULL, '2023-11-01 22:56:35', '2023-11-01 22:56:35');

--
-- Dump dei dati per la tabella `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '001_create_categorie_table', 1),
(2, '002_create_film_table', 1),
(3, '003_create_serie_tv_table', 1),
(4, '004_create_episodi_table', 1),
(5, '005_create_utenti_table', 1),
(6, '006_create_ruoli_utente_table', 1),
(7, '007_create_poteri_utente_table', 1),
(8, '008_create_utenti_ruoli_utente_table', 1),
(9, '009_create_ruoli_utente_poteri_utente_table', 1),
(10, '010_utenti_auth', 1),
(11, '011_create_password_utente_table', 1),
(12, '012_create_configurazioni_table', 1),
(13, '013_create_accessi_utente_table', 1),
(14, '014_create_sessioni_utente_table', 1),
(15, '015_chiavi_esterne', 1),
(16, '016_fatturazione', 1),
(17, '2019_12_14_000001_create_personal_access_tokens_table', 1);

--
-- Dump dei dati per la tabella `passwordUtente`
--

INSERT INTO `passwordUtente` (`idPasswordUtente`, `idUtente`, `psw`, `sale`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '025d4ef7bf0f6d67a558d98dfdafb5a630c86dc47bdbfeafd88574238ce14282221748cf7ef5b76ca799be6ee9b7cb2f67d40ccc107b7b0e3401d821814b288d', '95152e9691fc83283b811c9ce903cb603685ed5ea3c67a876a3985a2879446a75d2858f0bbbd78381a65faba31ad4bd8610ba704c09ed1b1190459862329900a', '2023-11-01 22:56:35', '2023-11-14 13:52:28', NULL),
(6, 2, 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', '858e854a56c6265b8aca438324751c5fd878e193cfa8cdb16141b5f467b7b398069a7efaf9dc39bba4713ea38fb6ea5c9b8e7b925bef755dcb27d57bf1dc9972', '2023-11-15 16:14:42', '2023-11-15 16:14:42', NULL);

--
-- Dump dei dati per la tabella `poteriUtente`
--

INSERT INTO `poteriUtente` (`idPotereUtente`, `nomePotere`, `potere`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Vedere', 'vedere', '2023-11-01 23:56:35', '2023-11-01 23:56:35', NULL),
(2, 'Creare', 'creare', '2023-11-01 23:56:35', '2023-11-01 23:56:35', NULL),
(3, 'Modificare', 'modificare', '2023-11-01 23:56:35', '2023-11-01 23:56:35', NULL),
(4, 'Eliminare', 'eliminare', '2023-11-01 23:56:35', '2023-11-01 23:56:35', NULL);

--
-- Dump dei dati per la tabella `ruoliUtente`
--

INSERT INTO `ruoliUtente` (`idRuoloUtente`, `ruolo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Amministratore', '2023-11-01 23:56:35', '2023-11-01 23:56:35', NULL),
(2, 'Utente', '2023-11-01 23:56:35', '2023-11-01 23:56:35', NULL),
(3, 'Ospite', '2023-11-01 23:56:35', '2023-11-01 23:56:35', NULL);

--
-- Dump dei dati per la tabella `ruoliUtente_poteriUtente`
--

INSERT INTO `ruoliUtente_poteriUtente` (`id`, `idRuoloUtente`, `idPotereUtente`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, '2023-11-01 23:56:35', '2023-11-01 23:56:35', NULL),
(2, 1, 2, '2023-11-01 20:02:42', '2023-11-01 20:04:23', NULL),
(5, 2, 1, '2023-11-01 23:56:35', '2023-11-01 23:56:35', NULL),
(6, 2, 3, '2023-11-01 23:56:35', '2023-11-01 23:56:35', NULL),
(8, 1, 3, '2023-11-01 20:04:13', '2023-11-01 20:04:28', NULL),
(11, 1, 4, '2023-11-01 20:04:19', '2023-11-01 20:04:31', NULL);

--
-- Dump dei dati per la tabella `serieTv`
--

INSERT INTO `serieTv` (`idSerieTv`, `titolo`, `durata`, `stagioni`, `episodi`, `regista`, `categoria`, `anno`, `trama`, `trailer`, `fotoAnteprima`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Dark', 45, 3, 28, 'Baran bo Odar', 'Horror', '2017', 'Baran Odar (Olten, 18 aprile 1978) è uno sceneggiatore e regista svizzero naturalizzato tedesco, principalmente conosciuto per aver diretto e co-creato le serie Netflix Dark e 1899.', NULL, NULL, NULL, '2023-11-01 22:56:35', '2023-11-01 22:56:35'),
(2, 'Breaking Bad', 42, 5, 62, 'Vince Gilligan', 'Horror', '2008', 'George Vincent Vince Gilligan Jr. (Richmond, 10 febbraio 1967) è uno sceneggiatore, regista e produttore televisivo statunitense, noto soprattutto per aver ideato la serie televisiva Breaking Bad e il suo spin-off Better Call Saul.', NULL, NULL, NULL, '2023-11-01 22:56:35', '2023-11-01 22:56:35'),
(3, 'How i met your mother', 20, 9, 208, 'Pamela Fryman', 'Sitcom', '2005', 'Nell\'anno 2030 Ted Mosby, un affermato architetto, inizia a raccontare ai suoi due figli gli eventi che, a partire da venticinque anni prima, lo hanno portato a conoscere quella che sarebbe diventata la sua futura moglie e loro madre.', NULL, NULL, NULL, '2023-11-01 22:56:35', '2023-11-01 22:56:35');

--
-- Dump dei dati per la tabella `sessioniUtente`
--

INSERT INTO `sessioniUtente` (`idSessioneUtente`, `idUtente`, `token`, `inizioSessione`) VALUES
(47, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL3d3dy5jb2RleC5pdCIsImF1ZCI6bnVsbCwiaWF0IjoxNzAwMDY4NzEwLCJuYmYiOjE3MDAwNjg3MTAsImV4cCI6MTcwMTM2NDcxMCwiZGF0YSI6eyJpZFV0ZW50ZSI6MSwiaWRTdGF0byI6MSwiaWRSdW9sb1V0ZW50ZSI6MSwicG90ZXJlIjpbMSwyLDMsNF0sIm5vbWUiOiJTbGF2aWMgRGlhY29ub3YifX0.aCsm8O9f7YglOVyX_IMtHaAbu0tQ3_yNlBwRef98B-w', '1700068710');

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`idUtente`, `idRuoloUtente`, `idStato`, `nome`, `cognome`, `sesso`, `codiceFiscale`, `cittadinanza`, `dataNascita`, `credito`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'Slavic', 'Diaconov', 1, 'cf62bb1e0d38c105eedeea8c815d25d7dcccab8175d692c3b96008aeacde03ade3eb022c6e8fbe9d7fe0950f6ab270d8934147eadb890aa0ac8076058f5ad20a', 'Mda', '1997-04-15', 0, '2023-11-01 23:56:35', '2023-11-01 23:56:35', NULL),
(2, 2, 1, 'Maria', 'Morosanu', 2, '489653105ea507e32be8d03d84bb3f64e4dc0c0d0528376a6a6a889514c5d5d73508662ab3cdc002c0bf105a1455d968ea0d6c9d4f148b107f710a9dca3bb485', 'Mda', '1996-05-27', 100, '2023-11-01 23:56:35', '2023-11-01 23:56:35', NULL);

--
-- Dump dei dati per la tabella `utentiAuth`
--

INSERT INTO `utentiAuth` (`idUtenteAuth`, `idUtente`, `user`, `sfida`, `secretJWT`, `inizioSfida`, `obbligoCambio`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '73742c49254bc788cfaea9927b9495ba3e1d24abb1f49a5ca31014aedde69c8798b04e0cf37b3297a08e2e88d9aef7a601935bbfca11a322cb699c93994cd5d6', '', '01c658e9b8ed1c4100c60d16dcbaaf75d27a3cac722a4b7add82123af4de7c3f2b3320e05cd555688fb2efa682558f8aa6ab724b4ea41300fe79b5c24cb87b5b', '1699995611', '', '2023-11-01 22:56:35', '2023-11-14 20:00:11', NULL),
(6, 2, 'b14361404c078ffd549c03db443c3fede2f3e534d73f78f77301ed97d4a436a9fd9db05ee8b325c0ad36438b43fec8510c204fc1c1edb21d0941c00e9e2c1ce2', '', 'b14361404c078ffd549c03db443c3fede2f3e534d73f78f77301ed97d4a436a9fd9db05ee8b325c0ad36438b43fec8510c204fc1c1edb21d0941c00e9e2c1ce2', '', '', '2023-11-15 16:14:42', '2023-11-15 16:14:42', NULL);

--
-- Dump dei dati per la tabella `utenti_ruoliUtente`
--

INSERT INTO `utenti_ruoliUtente` (`id`, `idUtente`, `idRuoloUtente`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, '2023-11-01 23:56:35', '2023-11-01 23:56:35', NULL),
(2, 2, 2, '2023-11-01 23:56:35', '2023-11-01 23:56:35', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
