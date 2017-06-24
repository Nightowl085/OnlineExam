-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2017 at 07:46 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlineexam`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_ujian`
--

CREATE TABLE `detail_ujian` (
  `Kode` int(11) NOT NULL,
  `Nomor` int(3) NOT NULL,
  `Soal` text NOT NULL,
  `A` text NOT NULL,
  `B` text NOT NULL,
  `C` text NOT NULL,
  `D` text NOT NULL,
  `E` text NOT NULL,
  `Jawaban` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_ujian`
--

INSERT INTO `detail_ujian` (`Kode`, `Nomor`, `Soal`, `A`, `B`, `C`, `D`, `E`, `Jawaban`) VALUES
(1, 1, 'Siapakah Rektor iSTTS selanjutnya?', 'Hartatarto Djunaedi S.Kom.,M.Kom.', 'Andre Rahardjo Liu', 'Ir. F.X. Ferdinandus M.T.', 'Prof. Dr. Ir. Gunawan M.T.', 'Ir. Herman Budianto M.M.', 'B'),
(1, 2, 'Siapakah Ketua Jurusan SIB Selanjutnya?', 'Prof. Joan S.Kom., M.Kom.', 'Stefanus Felix S.SI, M.SI', 'Abednego Setiawan', 'Andre Sumardjo', 'Dr. Abraham Will S.SI,M.SI', 'E'),
(2, 1, 'Kalimat yang terletak di awal paragraf adalah kalimat ....', 'Induktif', 'Deduktif', 'Campuran', 'Oktife', 'Pasif', 'B'),
(2, 2, ' Apa yang dimaksud dengan kalimat induktif...', 'Kalimat yang terletak di akhir paragraf', 'Kalimat yang terletak di awal paragraf', 'Kalimat yang terletak di awal dan akhir paragraf', 'Kalimat yang terletak di tengah paragraf', 'Kalimat yang tidak mempunyai paragraf', 'A'),
(2, 3, 'Apa yang membedakan antara kalimat induktif atau deduktif ....', 'Kalimat deduktif terletak di akhir paragraf dan sebaliknya', 'Kalimat Induktif terletak di awal paragraf', 'Kalimat induktif campuran deduktif di akhir paragraf', 'Kalimat deduktif campuran di awal paragraf dan sebaliknya', 'Kalimat yang tidak jelas letaknya', 'C'),
(2, 4, 'Susunan proses wawancara adalah ....', 'Pembukuan, pendahuluan, penutup, tahap inti', 'Penutup, pembuka, pendahuluan, tahap inti', 'Pendahuluan, pembuka, tahap inti dan penutup', 'Tahap inti, penutup, pembuka, pendahuluan', 'Penutup, tahap inti, pembuka, pendahuluan', 'C'),
(2, 5, 'Surat resmi yang dikeluarkan oleh instansi pemerintahan adalah surat ....', 'Dinas', 'Kuasa', 'Niaga', 'Umum', 'Sosial', 'A'),
(2, 6, 'Surat resmi yang digunakan oleh perusahaan atau badan usaha termasuk surat ....\r\n', 'Dinas', 'Umum', 'Sosial', 'Niaga', 'Kuasa', 'D'),
(2, 7, 'Jenis karangan yang melukiskan atau menggambarkan suatu objek apa adanya adalah karangan ....\r\n', 'Narasi', 'Argumentasi', 'Deskripsi', 'Persuasi', 'Eksposisi', 'C'),
(2, 8, 'Surat yang tidak mempunyai kepala surat adalah surat ....\r\n ', 'Dinas', 'Niaga', 'Pribadi', 'Umum', 'Kuasa', 'C'),
(2, 9, 'Proses dialog antara orang yang mencari informasi dengan orang yang memberikan informasi disebut ....\r\n', 'Resensi', 'Topik', 'Wawancara', 'Gagasan utama', 'Berita', 'C'),
(2, 10, 'Surat yang berisi pelimpahan kewenangan dari pemberi kuasa adalah surat .... ', 'Dinas', 'Niaga', 'Pribadi', 'Umum', 'Kuasa', 'E'),
(2, 11, 'Ciri-ciri cerita ulang....', 'Menceritakan peristiwa pada masa lalu, disusun secara kronologis. ', 'Menceritakan masalah aktual pada masa lalu.', 'Memberikan informasi tentang masa lalu', 'Memberikan hiburan pada pembaca', 'Berbagi pengalaman pada orang lain.', 'C'),
(2, 12, 'Sebagai suatu bentuk cerita yang berisi konflik, sikap dan sifat manusia dalam bentuk dialog disebut ....', 'Wawancara', 'Drama', 'Surat', 'Memo', 'Karangan', 'B'),
(2, 13, 'Kalimat yang tidak mempunyai kemungkinan banyak tafsir adalah kalimat ....\r\n', 'Induktif', 'Pasif', 'Deduktif', 'Ambigu', 'Campuran', 'C'),
(2, 14, 'Jenis karangan yang bertujuan untuk mempengaruhi pembaca dengan bukti-bukti atau alasan adalah karangan ....', 'Narasi', 'Argumentasi', 'Deskripsi', 'Persuasi', 'Eksposisi', 'D'),
(2, 15, ' Surat yang digunakan untuk organisasi kemasyarakatan adalah surat ....\r\n', 'Dinas', 'Sosial', 'Pribadi', 'Niaga', 'Kuasa', 'B'),
(2, 16, 'Bacalah kutipan berikut!\r\nSiswa kelas XII mengerjakan tugas pelajaran bahasa Indonesia secara mandiri.\r\nPada kalimat tersebut terdapat keteranganâ€¦..', 'Tujuan', 'Cara', 'Aposisi', 'Pewatas', 'Penyerta', 'A'),
(2, 17, 'Tulisan, ulasan/ timbangan mengenai nilai sebuah buku atau hasil karya disebut dengan .... ', 'Resensi', 'Topik', 'Berita', 'Gagasan utama', 'Wawancara', 'A'),
(2, 18, 'Secara global, penyakit hipertensi memiliki angka kematian yang cukup mencemaskan, yakni mencapai 7 juta orang meninggal pertahunnya di dunia.\r\n\r\nPenggalan kalimat teks diatas merupakan teksâ€¦', 'Teks sejarah', 'Teks Eksposisi', 'Teks Opini / Editorial', 'Teks Anekdot', 'Teks Preposisi', ''),
(2, 19, 'Sistematika cerita fiksi secara berurutan yaitu â€¦. ', 'Bagian atas, bagian bawah, dalam', 'Bagian tengah, akhir, awal', 'Bagian awal, tengah, akhir', 'Bagian dalam, luar, samping', 'Semua jawaban benar', 'E'),
(2, 20, ' Bacalah larik-larik puisi berikut!\r\n\r\nBuah mengkudu kusangka kandis\r\nKandis terletak dalam puan\r\nGula madu kusangka manis\r\nâ€¦â€¦â€¦.\r\n\r\nLarik yang tepat untuk melengkapi pantun di atas adalahâ€¦â€¦â€¦', 'Senyum adinda memang manis', 'Gula manis di dalam cawan', 'Bunga melati banyak yang suka', 'Kawan manis idaman hati', 'Manis lagi senyummu, Tuan', 'E'),
(3, 1, ' ___ software, such as operating systems and utility progams, consists of the program that control or maintain the operations of a computer and its devices.', 'System', 'Application', 'Management', 'Program', 'None of above', 'C'),
(3, 2, ' A(n)___system is a set of programs containing instructions that coordinate all the activities among computer hardware resources.', 'operating', 'disk-based', 'management', 'platform', 'None of above', 'A'),
(3, 3, 'A cross-platform program is one that runs ___. ', 'only on one operating system', 'differently on every operating system', 'the same on multiple operating systems', 'differently on one operating system', 'None of above', 'C'),
(3, 4, ' ___ is the process of starting or restarting a computer', 'Launching', 'Loading', 'Booting', 'Keying', 'None of the above', 'C'),
(3, 5, 'What\'s WWW ...', 'Web World Web', 'Web World Wide', 'Web Web Web', 'World Wide Web', 'Web Wide WEb', 'D'),
(3, 6, 'A single user/single ___ operating system allows only one user to run one program at the time.', 'throttle', 'function', 'indexing', 'tasking', 'none of the above', 'D'),
(3, 7, 'A single user/ ___ operating system allows a single user to work on two or more programs that reside in memory at the same time. ', 'multitasking', 'interfacing', 'command-based', 'throttle', 'none of above', 'A'),
(3, 8, 'A(n) ___ operating system enables two or more users to run programs simultaneously. ', 'multiplied', 'multiuser', 'engaged', 'rasterized', 'none of above', 'B'),
(3, 9, ' A(n) ___ computer is a computer that continues to operate when one of its components fails, ensuring that no data is lost.', 'failsafe', 'antivirus', 'immune', 'fault-tolerant', 'none of above', 'A'),
(3, 10, 'The purpose of memory ___ is to optimize the use of random access memory (RAM). ', 'performance', 'management', 'throttling', 'integration', 'none of above', 'B'),
(3, 11, ' With ___ memory, the operating system allocates a portion of a storage medium, usually the hard disk, to function as additional RAM.', 'virtual', 'performance', 'device', 'managed', 'none of above', 'A'),
(3, 12, 'A(n) ___ is a private combination of character associated with a user name that allows access to certain computer resources. ', 'folder', 'password', 'user name', 'cipher', 'none of above', 'B'),
(3, 13, '___ software is privately owned software and limited to a specific vendor or computer model. ', 'Stand-alone', 'Freeware', 'Proprietary', 'Shareware', 'none of above', 'A'),
(3, 14, ' A(n) ___ operating system is a complete operating system that works on a desktop computer, notebook computer, or mobile computing device.', 'multitasking', 'media-based', 'single-user', 'stand-alone', 'none of above', 'B'),
(3, 15, 'Soal Bonus', 'A', 'A', 'A', 'A', 'A', 'A'),
(3, 16, ' ___ is a multitasking operating system developed in the early 1970s by scientist at Bell Labs.', 'Linux', 'Perl', 'NetWare', 'UNIX', 'none of above', 'D'),
(3, 17, 'Soal Bonus', 'Bonus', 'Bonus', 'Bonus', 'Bonus', 'Bonus', 'A'),
(3, 18, 'Windows ___ is a scaled-down Windows operating system designed for use on communications, entertainment, and computing devices with limited functionality ', 'UNIX', 'NetWare', 'Server', 'Embedded CE', 'none of above', 'D'),
(3, 19, ' A competing operating system to Windows Mobile is Palm ___, which runs on Palm powered PDAs and smart phones.', 'UNIX', 'OS', 'CE', 'Mobile', 'none of above', 'B'),
(3, 20, ' A(n) ___ is a specific named location on storage medium that contains related documents.', 'firewall', 'password', 'folder', 'passkey', 'none of above', 'C'),
(4, 1, ' A(n) ___ viewer is a utility that allows user to display, copy, and print the contents of a graphics file.', 'graphics', 'JPEG', 'PNG', 'image', 'none of above', ''),
(4, 2, 'In the event a backup file is used, a(n) ___ program reverses the process and returns backed up files to their original form. ', 'restore', 'return', 'reversal', 'backup', 'none of above', 'D'),
(4, 3, ' A(n) ___ is someone who tries to access a computer or network illegally', 'uninstaller', 'hacker', 'backup', 'cyberterrorist', 'none of above', 'B'),
(4, 4, 'Who\'s HTML Inventor', 'Audrey Ayu D.', 'Johan Pranata', 'God', 'Angels', 'Tim Banners Lee', 'E'),
(4, 5, 'Who\'s God?', 'Jesus', 'Messiah', 'Sikh', 'Jwesih', 'Juddah', 'A'),
(4, 6, '___ is a program that removes or blocks certain items from being displayed.', 'Spyware', 'A pop-up ad', 'Spam', 'A filter', 'none of above', 'D'),
(4, 7, ' Computer communications describes a process in which two or more computers or devices transfer ___.', 'data', 'information', 'instructions', 'all of the above', 'none of the above', 'B'),
(4, 8, ' ___ can serve as sending and receiving devices in a communications system.', 'Mainframe computers and servers', 'Desktop computer and notebook computers', 'Smart phones', 'All the above', 'none of the above', 'D'),
(4, 9, ' A type of communications device that connects a communications channel to a sending or receiving device is a ___.', 'modem', 'server', 'PDA', 'all of the above', 'none of above', 'A'),
(4, 10, ' ___ is a real-time Internet communications service that allows wireless mobile devices to exchange messages with one or more mobile devices or online users.', 'A chat room', 'Wireless instant messaging', 'MMS', 'Voice mail', 'none of above', 'A'),
(4, 11, ' Some services use the term video ___ to refer separately to teh capability of sending video clips.', 'circuiting', 'posting', 'messaging', 'spotting', 'none of above', 'B'),
(4, 12, ' A(n) ___ is a wireless network that provides Internet connection to mobile computers and other devices.', 'wi-spot', 'hot link', 'quick spot', 'hot spot', 'none of above', 'D'),
(4, 13, ' ___ is a network standard that specifies no central computer or device on the network should control when data can be transmitted.', 'Ethernet', 'Telnet', 'IEEE', 'Gopher', 'none of above', 'C'),
(4, 14, ' The ___ identifies any network based on the 802.11 family of standards.', 'mesh', 'IEEE', 'Wi-Fi', 'FireWire', 'none of above', 'C'),
(4, 15, ' Some entire cities are se up as a Wi-Fi ___ network, in which mesh node routes its data to the next next available node until the data reaches its destination - usually an Internet connection.', 'interpolated', 'synthetic', 'integrated', 'mesh', 'none of above', 'C'),
(4, 16, 'The communications device that connects a communications channel to a sending or\r\nreceiving device such as a computer is a(n) ____. ', 'modem', 'CATV', 'digitizer', 'interpolator', 'none of above', 'A'),
(4, 17, ' DSL ___.', 'uses a modem that sends digital data and information from a DSL line', 'is much slower than dial-up services', 'uses a line that is shared with other users in the neighborhood', 'all of the above', 'none of the above', 'C'),
(4, 18, ' For smaller business and home networks, a ____ allows multiple computers to share a single\r\nhigh-speed Internet connection such as through a cable modem or DSL modem. ', 'multiplexer', 'router', 'grid', 'baseband modem', 'none of above', 'A'),
(4, 19, ' ___ media consist of materials or substances capable of carrying one or more signals.', 'Wireless', 'Signals', 'Communication', 'Transmissions', 'none of above', 'C'),
(4, 20, ' For the best performance of a communications channel, ___.', 'bandwith and latency should be low', 'bandwith should be low and latency high', 'bandwidth should be high and latency low', 'bandwidth and latency should be high', 'none of above', ''),
(5, 1, ' 1.	Apabila -192 + (-12) * 7 = k, berapakah nilai k?', '-1428', '1428', '-276', '276', '1', 'C'),
(5, 2, 'Nayla membeli rambutan 6 Kg, tiap kilogram berisi 42 buah. Buah rambutan tersebut akan dibagikan kepada teman sekelasnya yang berjumlah 46 orang. Berapa buah rambutan yang diterima masing-masing teman sekolah Nayla?', '8 buah', '7 buah', '6 buah', '5 buah', '1 buah', 'D'),
(5, 3, 'Hasil dari 312 â€“ 26 : 18 adalah?', '300', '17', '113', '176', '1', 'C'),
(5, 4, 'Hasil dari 24 â€“ 2 * 5 + 3 =', '8', '17', '113', '176', '1', 'B'),
(5, 5, 'Bu Badri membeli gula pasir 6 kg, beras 25 kg, dan telur 4kg, Harga setiap 1 kg gula pasir Rp 12.600,00, beras Rp 8.200,00, dan telur Rp. 18.500,00. Bu Badri membayar dengan 4 lembar uang seratus ribuan. Bu Badri menerima uang pengembalian sebanyak...', 'Rp. 45.400,00', 'Rp. 46.400,00', 'Rp. 55.400,00', 'Rp. 56.400,00', 'Rp. 1,00', 'C'),
(5, 6, 'Hasil dari 872 + 63 * (-9) â€“ 927 / (-9) = ', '408', '318', '292', '202', '1', 'D'),
(5, 7, 'Hasil 212 â€“ 132 =', '16', '64', '272', '282', '1', 'C'),
(5, 8, 'Sebuah bak penampungan air berbentuk kubus. Setengah bak tersebut berisi air sebanyak 23.328 dm3. Tinggi bak tersebut adalah...', '36 dm', '38 dm', '46 dm', '48 dm', '1 dm', 'D'),
(5, 9, 'Sinta mempunyai tiga utas tali dengan panjang 425 cm, 52.8 dm, 4.6m. Ketiga tali disambung. Setiap sambungan, ujung tali berkurang 0.9 dm. Panjang tali Sinta setelah disambung adalah?', '137.7 m', '136.7 m', '13.95 m', '13.77 m', '1 m', 'A'),
(5, 10, 'Perhutani memiliki tanah seluas 0.25 hektar. Tanah tersebut ditanami pohon mahoni 625 m2, pohon jadi 12.25 area, dan dibuat tambah 500 m2. Selebihnya dibuat tempat parkir. Luas tempat parkir adalah...', '75 m2', '125 m2', '150 m2', '250 m2', '1 m2', 'B'),
(5, 11, 'Jarak rumah Rina ke rumah Dewi 27 km. Rina pergi ke rumah Dewi mengendarai sepeda motor dengan kecepatan rata-rata 45km/h. Tiba di rumah Dewi pukul 16:23. Rina berangkat dari rumah pukul...', '16:59', '16:47', '15:47', '15:23', '00:01', 'D'),
(5, 12, ' Sebuah bangun datar memiliki ciri-ciri: Mempunyai 2 pasang sudut berhadapan sama besar, Mempunyai 2 pasang sisi sejajar sama panjang, Memiliki diagonal yang saling berpotongan tegak lurus, Memiliki 2 sumbu simetri. Bangun datar yang sesuai ciri-ciri di atas adalah...\r\n', 'Jajar genjang', 'Belah ketupat', 'Trapesium sama kaki', 'Persegi Panjang', 'Segitiga sama sisi', 'A'),
(5, 13, 'Hasil dari 37 â€“ 23 adalah', '2625', '1256', '3600', '840', '14', 'E'),
(5, 14, 'Sebuah kubus memiliki volume 2197 cm3. Berapakah panjang rusuk kubus tersebut?', '9 cm', '10 cm', '11 cm', '13 cm', '1', 'C'),
(5, 15, 'Epi mempunyai tali tambang sepanjang 270 dm. Tali tersebut digunakan untuk membuat jemuran sepanjang 6,5 m. Sisa dari talit tersebut akan digunakan untuk membuat prakarya, karena masih kurang, Epi membeli lagi tali sepanjang 150 cm. Tali yang digunakan untuk membuat prakarya adalah ___ m', '20,5', '22', '35', '35,5', '1', 'B'),
(5, 16, 'Pak Kenong mengisi bak mandi dengan air selama 0,75 jam. Jika debit air yang mengalir 18 liter per menit, volume air yang telah mengalir sebanyak ___ liter', '810', '180', '108', '1350', '1', 'D'),
(5, 17, 'Ayah berangkat bekerja dengan mengendarai sepeda motor dengan kecepatan rata-rata 80km/h. Ia berangkat dari rumah pukul 05:30. Jika ia sampai kantor pukul 06:45, berapa jarak yang ditempuh oleh ayah?', '80 km', '90 km', '100 km', '110 km', '1 km', 'B'),
(5, 18, 'Andre punya 4 apel, lalu Andreas memberi 10 apel kepada Andre. Berapa banyak apel yang dimiliki oleh Andre sekarang?', '14', '15', '16', '17', '18', 'A'),
(5, 19, 'Andre punya 20 stiker, lalu memberikan 5 dari stiker miliknya kepada Nikolas. Berapa banyak stiker milik Nikolas sekarang?', '5', '6', '7', '15', '14', 'D'),
(5, 20, 'Andre memiliki uang sebanyak 4000, Felix kasihan melihat Andre tidak bisa membeli makanan, lalu memberikan uang sebanyak 10000 kepada Andre. Lalu Andre membeli makanan seharga 5000. Berapa uang yang ada di tangan Andre sekarang?', '5000', '6000', '7000', '8000', '9000', 'E'),
(6, 1, ' Apa Nama Panjang dari Abed Febrian K., sebutkan kepanjangan K.', 'Koentjoro', 'Kuncoro', 'Koencoro', 'Kuntjoro', 'Koentchoro', 'A'),
(6, 2, 'Sebutkan Asal rumah Ongky Putra H.,', 'Palembang', 'Jakarta', 'Surabaya', 'Jember', 'Ambulu', 'D'),
(6, 3, 'Sebutkan jumlah kursi di audit saat Acara DIES NATALIS iSTTS', '133', '173', '154', '178', '143', 'A'),
(6, 4, ' Sebutkan jumlah ikan di kolam iSTTS', '6', '7', '10', '9', '12', 'E'),
(6, 5, ' Sebutkan umur orang yang ada di soal nomor 1', '20', '26', '23', '21', '24', 'C'),
(6, 6, 'Tindakan terbaik yang anda lakukan apabila ujian anda divonis TBU oleh kampus', 'OD', 'DO', 'Drop Mata Kuliah', 'Datang saat ujian, dan mengerjakan', 'Datang, tatap asisten, lalu pulang', 'E'),
(6, 7, 'Siapa kepala program studi SIB iSTTS', 'Bpk. Herman Thuan', 'Bpk. Benyamin Limanto', 'Bpk. Arya Tandy Hermawan', 'Bpk. Joseph Sandy Haharvian', 'Bpk. Prassssssssssssssss', 'A'),
(6, 8, 'Sebutkan nama ketua BEM 2018', 'Ongky Putra H.', 'Memet', 'Daniel Hanamasa', 'Jefry Hadinata', 'Luke Nugroho', 'A'),
(6, 9, 'Sebutkan jumlah ruangan di gedung U-100', '2', '4', '6', '8', '3', 'E'),
(6, 10, 'Apa warna gorden ruangan N204', 'Ungu', 'Merah', 'Cream', 'Putih', 'Pink', 'C'),
(6, 11, ' Diantara jawaban berikut, manakah web iSTTS yang benar.', 'stts.sim.edu', 'edu.stts.sim', 'sim.stts.education', 'sim.stts.edu', 'aryaschool.stts.indraschool', 'D'),
(6, 12, 'Berapa jumlah bus yang istts punya', '2', '1', '3', '4', 'Tidak ada', 'E'),
(6, 13, ' Apa jabatan Benyamin saat ini?', 'Wakil rektor', 'Ketua kemahasiswaan', 'Ketua kaprodi SIB', 'Ketua HIMASIB', 'Pegawai IT', 'E'),
(6, 14, 'Berapa SKS standar di iSTTS?', '24', '27', '18', '21', '144', 'C'),
(6, 15, 'BEM iSTTS terletak di ruangan?', 'B-101', 'E-104', 'N-303', 'L-409', 'B-403', 'E'),
(6, 16, 'Siapa anak paling hedon di SIB?', 'Jefry H.', 'Jonathan Regan', 'Benyamin L.', 'Andre R.', 'Ongky Putra H.', 'A'),
(6, 17, 'Siapa nama di bawah ini yang pernah hit & run di Palapa?', 'Benyamin', 'Jefry', 'Abraham', 'Regan', 'Abed', 'D'),
(6, 18, 'Apa warna gedung U iSTTS?', 'Coklat', 'Merah klenteng', 'Maroon', 'Batu bata', 'Coklat bata', 'B'),
(6, 19, 'Berapa harga ayam goreng mentega di Jon In iSTTS', '15.000', '20.000', '13.000', '11.000', '14.000', 'D'),
(6, 20, 'Jam berapa Jon In tutup?', 'Jam 3', 'Jam 4', '24 Jam', 'Jam 5', 'Sak habis e...', 'E'),
(7, 1, 'Siapa nama kajur SIB', 'joifoiqji', 'ijifjqi', 'jifiqm', 'ijfieoi', 'ifjeijg', 'C'),
(7, 2, 'jfiomqo', 'ijifjim', 'ijiefi', 'mimiie', 'iefjioew', 'imvie', 'A'),
(7, 3, 'Tetst', 'irifom', 'imiofiemfei', 'imoiefm', 'nefnung', 'ugenn', 'A'),
(7, 4, 'oiewmiviwmio', 'ifmiwfio', 'ifmoiemw', 'oijiof', 'fmksl', 'ojfemkq', 'A'),
(7, 5, 'jiofwm', 'jifmoi', 'mfieqmd', 'oimfioqmed', 'foimweoeif', 'ifoe2jmewf', 'C'),
(7, 6, 'anfnsi', 'ijfiojaiosdjio', 'ijfij', 'iofiom', 'iomiimif', 'ifemimf', 'A'),
(7, 7, ' iojiowjio', 'ifeioqmd', 'iodmqomio', 'midoqmoi', 'miodmoim', 'omdwiomio', 'D'),
(7, 8, 'kdmifn', 'fioims', 'mdoiqmdoi', 'mfiomwd', 'ifemio', 'nfnu', 'C'),
(7, 9, ' iwjiqojfim', 'jiojdiom', 'mifomiom', 'imioug', 'ionnuo', 'njoij', 'D'),
(7, 10, 'jiojmijoi', 'ijijjio', 'ijijjkl', 'hofioj', 'ij', 'iiofjoej', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `NID` varchar(11) NOT NULL,
  `Password` varchar(65) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `Alamat` text NOT NULL,
  `Telpon` varchar(20) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`NID`, `Password`, `Nama`, `Alamat`, `Telpon`, `Email`, `Status`) VALUES
('D123', '$2y$10$ioG9sv8nKpe5n0RtxhGBCOOBSaS2zZiLYH88EnLq06h6ReuAZV8bq', 'Gohan', 'Jl. Langit Jaya 10 Surga', '12391273912793', 'Gohan@gmail.com', 1),
('D1234', '$2y$10$6hp0AG0bdbWj2xhBEyfQsedZkH.vHzRZWywlx9qN4hqhSI7dmHs62', 'Johan Sugiarto', 'Jl. Ikan Lohan 1 Malang', '0341593776', 'johan@stts.edu', 1),
('D2345', '$2y$10$IldgOv68qFE5GysI9JhAL.7G3qFT.Hi74zSf2x8RPb0/kVldr4Mv.', 'Joseph Sandy H S.SI, M.Hum, M.A', 'Jl. Dharmawangsa 10 Surabaya', '0315789203', 'joseph@shandy.com', 0),
('D3456', '$2y$10$84DePZrS.o6RDO.UunnMXOWPkj7rqwafLk0YcMDsaWzm633n9rFu6', 'Eric Sugiharto, S.SI, M.Kom', 'Jl. Ngagel Jaya Tengah 73-77 Surabaya', '0313551830', 'eric@stts.edu', 0);

-- --------------------------------------------------------

--
-- Table structure for table `header_ujian`
--

CREATE TABLE `header_ujian` (
  `Kode` int(11) NOT NULL,
  `Nama` text NOT NULL,
  `Tanggal` datetime NOT NULL,
  `Waktu` int(3) NOT NULL,
  `banyak` int(11) DEFAULT NULL,
  `NID` varchar(11) DEFAULT NULL,
  `Kode Matkul` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Waktu dalam menit';

--
-- Dumping data for table `header_ujian`
--

INSERT INTO `header_ujian` (`Kode`, `Nama`, `Tanggal`, `Waktu`, `banyak`, `NID`, `Kode Matkul`) VALUES
(1, 'Testing Ujian Online', '2017-06-15 10:10:00', 60, NULL, 'D1234', 1),
(2, 'Bahasa Indonesia', '2017-06-16 22:30:00', 60, 20, 'D1234', 1),
(3, 'ITC Global Trend', '2017-06-16 16:40:00', 60, 20, 'D1234', 1),
(4, 'ITC parte 2', '2017-06-16 16:20:00', 20, 20, 'D1234', 1),
(5, 'UAS Matematika', '2017-06-16 18:00:00', 40, 20, 'D2345', 10),
(6, '  UAS Ilmu Pengetahuan Umum', '2017-06-16 18:00:00', 10, 20, 'D1234', 11),
(7, 'Pengetahuan SIB', '2017-06-16 17:56:00', 5, 10, 'D1234', 11);

-- --------------------------------------------------------

--
-- Table structure for table `jawaban_mahasiswa`
--

CREATE TABLE `jawaban_mahasiswa` (
  `Kode` int(11) NOT NULL,
  `NRP` int(11) NOT NULL,
  `Nomor` int(3) NOT NULL,
  `Jawaban` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabel Jawaban Mahasiswa';

--
-- Dumping data for table `jawaban_mahasiswa`
--

INSERT INTO `jawaban_mahasiswa` (`Kode`, `NRP`, `Nomor`, `Jawaban`) VALUES
(1, 215180351, 1, 'B'),
(1, 215180351, 2, 'E'),
(3, 215180351, 1, 'C'),
(3, 215180351, 2, 'D'),
(3, 215180351, 3, 'C'),
(3, 215180351, 4, 'C'),
(3, 215180351, 5, 'C'),
(3, 215180351, 6, 'C'),
(3, 215180351, 7, 'C'),
(3, 215180351, 8, 'D'),
(3, 215180351, 9, 'D'),
(3, 215180351, 10, 'D'),
(3, 215180351, 11, 'D'),
(3, 215180351, 12, 'E'),
(3, 215180351, 13, 'A'),
(3, 215180351, 14, 'D'),
(3, 215180351, 15, 'E'),
(3, 215180351, 16, 'B'),
(3, 215180351, 17, 'A'),
(3, 215180351, 18, 'D'),
(3, 215180351, 19, 'A'),
(3, 215180351, 20, 'A'),
(4, 0, 1, 'A'),
(4, 0, 2, 'B'),
(4, 0, 3, 'B'),
(4, 0, 4, 'A'),
(4, 0, 5, 'D'),
(4, 0, 6, ''),
(4, 0, 7, ''),
(4, 0, 8, ''),
(4, 0, 9, ''),
(4, 0, 10, ''),
(6, 215180348, 1, 'A'),
(6, 215180348, 2, 'A'),
(6, 215180348, 3, ''),
(6, 215180348, 4, ''),
(6, 215180348, 5, ''),
(6, 215180351, 1, 'E'),
(6, 215180351, 2, 'E'),
(6, 215180351, 3, 'B'),
(6, 215180351, 4, 'E'),
(6, 215180351, 5, 'E'),
(6, 215180351, 6, 'E'),
(6, 215180351, 7, 'A'),
(6, 215180351, 8, 'A'),
(6, 215180351, 9, 'E'),
(6, 215180351, 10, 'E'),
(6, 215180351, 11, 'D'),
(6, 215180351, 12, 'E'),
(6, 215180351, 13, 'E'),
(6, 215180351, 14, 'A'),
(6, 215180351, 15, 'D'),
(6, 215180351, 16, 'A'),
(6, 215180351, 17, 'E'),
(6, 215180351, 18, 'B'),
(6, 215180351, 19, 'D'),
(6, 215180351, 20, 'B');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `NRP` int(11) NOT NULL,
  `Password` varchar(60) NOT NULL,
  `Nama` varchar(150) NOT NULL,
  `Alamat` text NOT NULL,
  `Telpon` varchar(20) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabel Mahasiswa untuk Auth dan Profile';

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`NRP`, `Password`, `Nama`, `Alamat`, `Telpon`, `Email`, `status`) VALUES
(215180348, '$2y$10$tIQ.0qZ0qytr8I3OgmOcLeK9XhrHtKVk0Vzm4.1XHZXzIepPhK74K', 'Andre Rahardjoasdasd', 'Jl. Panggung 10 Surabaya', '031678902', 'andre.rahardjo.liu@gmail.com', 1),
(215180350, '$2y$10$n4glutByOftgKwCEUdcjtecRn/OGzdBdByOdtEC7pLlbgS7SJYCRm', 'Angelia Gunawan', 'Jl. Sigura-gura1100 Probolinggo', '0343567890', 'angel@gunawan.co.id', 1),
(215180351, '$2y$10$nA0qR7N2d0Y6tnn.IFvjHunT0E7m4MTcsF6ZC5ZL1WSOoXISxt7/6', 'Benyamin', 'Jl. Panggung 49', '0313551830', 'blbenyamin9@gmail.com', 1),
(215180357, '$2y$10$3PB1Vub/BhVKKMcCXHXL8e4OjLSjg9YzGIgsDAMD/QFaGQjlv743C', 'Jeffry Hadinata', 'Jl. Sidodadi Prima 10', '0313551830', 'jeffry.hadinata@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mata kuliah`
--

CREATE TABLE `mata kuliah` (
  `Kode Matkul` int(11) NOT NULL,
  `Nama Matkul` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabel Mata Kuliah yang ada';

--
-- Dumping data for table `mata kuliah`
--

INSERT INTO `mata kuliah` (`Kode Matkul`, `Nama Matkul`, `status`) VALUES
(1, 'Aplikasi Internetku', 1),
(2, 'Multimedia', 1),
(3, 'Pemrograman Client Server', 1),
(5, 'Algoritma Pemrograman', 1),
(6, 'Basis Data', 1),
(8, 'Pemrograman Berbasis Object', 1),
(9, 'Jaringan Komputer', 1),
(10, 'Matematika Dasar', 1),
(11, 'Pengetahuan Umum', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mengajar`
--

CREATE TABLE `mengajar` (
  `Kode Matkul` int(11) NOT NULL DEFAULT '0',
  `NID` varchar(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Setiap Dosen mengajar sebuah mata kuliah, dan dicatat disini';

--
-- Dumping data for table `mengajar`
--

INSERT INTO `mengajar` (`Kode Matkul`, `NID`) VALUES
(1, 'D123'),
(1, 'D1234'),
(6, 'D1234'),
(11, 'D1234'),
(10, 'D2345');

-- --------------------------------------------------------

--
-- Table structure for table `mengambil`
--

CREATE TABLE `mengambil` (
  `NRP` int(11) NOT NULL,
  `NID` varchar(11) NOT NULL DEFAULT '',
  `Kode Matkul` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Mahasiswa Mengambil Mata Kuliah';

--
-- Dumping data for table `mengambil`
--

INSERT INTO `mengambil` (`NRP`, `NID`, `Kode Matkul`) VALUES
(215180351, 'D123', 1),
(215180348, 'D1234', 1),
(215180350, 'D1234', 1),
(215180351, 'D1234', 1),
(215180351, 'D1234', 6),
(215180351, 'D2345', 10),
(215180348, 'D1234', 11),
(215180351, 'D1234', 11);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `Kode Ujian` int(11) DEFAULT NULL,
  `Kode Matkul` int(11) NOT NULL,
  `NID` varchar(11) NOT NULL,
  `NRP` int(11) NOT NULL,
  `Nilai` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`Kode Ujian`, `Kode Matkul`, `NID`, `NRP`, `Nilai`) VALUES
(1, 1, 'D1234', 215180351, 95),
(4, 1, 'D1234', 215180351, 5),
(4, 1, 'D1234', 215180351, 5),
(3, 1, 'D1234', 215180351, 30),
(6, 11, 'D1234', 215180351, 55),
(6, 11, 'D1234', 215180348, 20),
(5, 10, 'D2345', 215180351, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reset_password`
--

CREATE TABLE `reset_password` (
  `Kode` varchar(11) NOT NULL,
  `USERID` varchar(11) DEFAULT NULL,
  `Tanggal` datetime DEFAULT NULL,
  `Expired` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Semua Password Request Akan ditampung disini. Jika kode tidak ditemukan, maka tidak diperbolehkan Request Password';

--
-- Dumping data for table `reset_password`
--

INSERT INTO `reset_password` (`Kode`, `USERID`, `Tanggal`, `Expired`, `status`) VALUES
('atc3tAfiFp', '215180351', '2017-06-09 03:45:06', '2017-06-11 03:45:06', 1),
('BN9BzlXOJh', '215180351', '2017-06-09 03:15:59', '2017-06-11 03:15:59', 1),
('bWCDm7b6Hg', '215180351', '2017-06-09 03:45:42', '2017-06-11 03:45:42', 1),
('Cvpkm22u6N', '215180351', '2017-06-11 19:16:51', '2017-06-13 19:16:51', 1),
('hUWO2PYN0x', '215180351', '2017-06-10 12:15:06', '2017-06-12 12:15:06', 1),
('iMRSwJ5UMq', '215180351', '2017-06-09 08:58:39', '2017-06-11 08:58:39', 1),
('JsU130fOC1', '215180351', '2017-06-10 12:08:03', '2017-06-12 12:08:03', 1),
('odPr8rdAPb', '215180351', '2017-06-07 10:29:10', '2017-06-09 10:29:10', 1),
('PcOfKAEcq3', '215180351', '2017-06-10 11:57:23', '2017-06-12 11:57:23', 1),
('rCuc8CN90h', '215180351', '2017-06-09 03:22:06', '2017-06-11 03:22:06', 1),
('yatdELOKZy', '215180351', '2017-06-07 10:27:35', '2017-06-09 10:27:35', 1),
('z9Rj82Ba8e', '215180351', '2017-06-11 19:24:41', '2017-06-13 19:24:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `Kode Tugas` int(11) NOT NULL,
  `Kode Matkul` int(11) NOT NULL DEFAULT '0',
  `Kode Dosen` varchar(11) NOT NULL,
  `Tanggal_Kumpul` datetime DEFAULT NULL,
  `Keterangan Tugas` text,
  `Nama Tugas` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabel untuk tugas yang akan dikumpul';

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`Kode Tugas`, `Kode Matkul`, `Kode Dosen`, `Tanggal_Kumpul`, `Keterangan Tugas`, `Nama Tugas`) VALUES
(20, 1, 'D123', '2017-06-16 09:00:00', 'ajaslkdjalsjdlaksjl', 'lkajdlskja'),
(23, 1, 'D1234', '2017-06-24 17:00:00', 'Kerjakan sesuai tugas, kumpulkan dengan hati nurani', 'Proyek terakhir');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_ujian`
--
ALTER TABLE `detail_ujian`
  ADD PRIMARY KEY (`Kode`,`Nomor`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`NID`);

--
-- Indexes for table `header_ujian`
--
ALTER TABLE `header_ujian`
  ADD PRIMARY KEY (`Kode`);

--
-- Indexes for table `jawaban_mahasiswa`
--
ALTER TABLE `jawaban_mahasiswa`
  ADD PRIMARY KEY (`Kode`,`NRP`,`Nomor`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`NRP`);

--
-- Indexes for table `mata kuliah`
--
ALTER TABLE `mata kuliah`
  ADD PRIMARY KEY (`Kode Matkul`);

--
-- Indexes for table `mengajar`
--
ALTER TABLE `mengajar`
  ADD PRIMARY KEY (`Kode Matkul`,`NID`),
  ADD KEY `mengajar_dosen_NID_fk` (`NID`);

--
-- Indexes for table `mengambil`
--
ALTER TABLE `mengambil`
  ADD PRIMARY KEY (`NRP`,`NID`,`Kode Matkul`),
  ADD KEY `mengambil_mengajar_Kode Matkul_NID_fk` (`Kode Matkul`,`NID`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD KEY `nilai_mengajar_NID_fk` (`NID`),
  ADD KEY `nilai_mengambil_NRP_fk` (`NRP`);

--
-- Indexes for table `reset_password`
--
ALTER TABLE `reset_password`
  ADD PRIMARY KEY (`Kode`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`Kode Tugas`),
  ADD KEY `tugas_mata kuliah_Kode Matkul_fk` (`Kode Matkul`),
  ADD KEY `tugas_mengajar_NID_fk` (`Kode Dosen`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `header_ujian`
--
ALTER TABLE `header_ujian`
  MODIFY `Kode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `mata kuliah`
--
ALTER TABLE `mata kuliah`
  MODIFY `Kode Matkul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `Kode Tugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `mengajar`
--
ALTER TABLE `mengajar`
  ADD CONSTRAINT `mengajar_dosen_NID_fk` FOREIGN KEY (`NID`) REFERENCES `dosen` (`NID`),
  ADD CONSTRAINT `mengajar_mata kuliah_Kode Matkul_fk` FOREIGN KEY (`Kode Matkul`) REFERENCES `mata kuliah` (`Kode Matkul`);

--
-- Constraints for table `mengambil`
--
ALTER TABLE `mengambil`
  ADD CONSTRAINT `mengambil_mahasiswa_nrp_fk` FOREIGN KEY (`NRP`) REFERENCES `mahasiswa` (`NRP`),
  ADD CONSTRAINT `mengambil_mengajar_Kode Matkul_NID_fk` FOREIGN KEY (`Kode Matkul`,`NID`) REFERENCES `mengajar` (`Kode Matkul`, `NID`);

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_mengajar_NID_fk` FOREIGN KEY (`NID`) REFERENCES `mengajar` (`NID`),
  ADD CONSTRAINT `nilai_mengambil_NRP_fk` FOREIGN KEY (`NRP`) REFERENCES `mengambil` (`NRP`);

--
-- Constraints for table `tugas`
--
ALTER TABLE `tugas`
  ADD CONSTRAINT `tugas_mata kuliah_Kode Matkul_fk` FOREIGN KEY (`Kode Matkul`) REFERENCES `mata kuliah` (`Kode Matkul`),
  ADD CONSTRAINT `tugas_mengajar_NID_fk` FOREIGN KEY (`Kode Dosen`) REFERENCES `mengajar` (`NID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
