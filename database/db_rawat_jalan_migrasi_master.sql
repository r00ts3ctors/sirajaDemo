-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Okt 2020 pada 21.43
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rawat_jalan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_asesmen`
--

CREATE TABLE `tbl_asesmen` (
  `id_asesmen` int(10) NOT NULL,
  `pekerjaan_dukungan` varchar(10) NOT NULL,
  `resume_masalah` mediumtext NOT NULL,
  `medis` varchar(10) NOT NULL,
  `napza` varchar(10) NOT NULL,
  `legal` varchar(10) NOT NULL,
  `keluarga_sosial` varchar(10) NOT NULL,
  `psikiatris` varchar(10) NOT NULL,
  `kriteria_diagnosis_napza` varchar(100) NOT NULL,
  `diagnosis_lainnya` varchar(100) NOT NULL,
  `rencana_terapi` varchar(200) NOT NULL,
  `id_disposisi` int(20) NOT NULL,
  `id_surat` int(10) NOT NULL,
  `id_user` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_asesmen`
--

INSERT INTO `tbl_asesmen` (`id_asesmen`, `pekerjaan_dukungan`, `resume_masalah`, `medis`, `napza`, `legal`, `keluarga_sosial`, `psikiatris`, `kriteria_diagnosis_napza`, `diagnosis_lainnya`, `rencana_terapi`, `id_disposisi`, `id_surat`, `id_user`) VALUES
(40, '4', 'iaiaiaisss', '3', '5', '4', '4', '3,9', 'sdfs', 'fsd', '1. Asesmen lanjutan / mendalam', 12, 0, 1),
(41, '2', '1. Asesmen lanjutan / mendalam', '1', '3', '3', '3', '3', 'aa', 'vvv', 'ccc', 10, 0, 1),
(42, '5', 'kkkki', '5', '4', '5', '6', '7', 'aaaaaaaaaaaaaaaaaa', 'bbbbbbbbbbbbbbbbbbb', '3. Program Detoksifikasi', 13, 0, 1),
(43, '3', '1. Asesmen lanjutan / mendalam', '0', '2', '4', '6', '6', 'aaaaaaaaaaaaaaaaa', 'bbbbbbbbbbbb', 'ccccccccccc', 15, 0, 1),
(44, '1', '2. Evaluasi Psikologis', '1', '1', '1', '2', '2', 'ss', 'ss', 'sss', 0, 0, 1),
(45, '6', '2. Evaluasi Psikologis', '7', '8', '7', '6', '7', 'ss', 'sss', 'sss', 16, 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_disposisi`
--

CREATE TABLE `tbl_disposisi` (
  `id_disposisi` int(10) NOT NULL,
  `tujuan` varchar(250) NOT NULL,
  `isi_disposisi` mediumtext NOT NULL,
  `sifat` varchar(100) NOT NULL,
  `batas_waktu` date NOT NULL,
  `catatan` varchar(250) NOT NULL,
  `id_surat` int(10) NOT NULL,
  `id_user` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_disposisi`
--

INSERT INTO `tbl_disposisi` (`id_disposisi`, `tujuan`, `isi_disposisi`, `sifat`, `batas_waktu`, `catatan`, `id_surat`, `id_user`) VALUES
(10, '', 'lalalalallal', '08:00 Wib', '2020-09-29', '', 30, 1),
(11, '', 'ke 2', '08:00 Wib', '2020-09-24', '', 30, 1),
(12, '', 'janji ketemu', '09:00 Wib', '2020-09-19', '', 33, 1),
(13, '', 'oke fix', '11:30 Wib', '2020-09-20', '', 33, 1),
(16, '', 'lll', '08:00 Wib', '2020-09-28', '', 32, 1),
(17, '', 'oke', '08:00 Wib', '2020-09-29', '', 32, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_informasi`
--

CREATE TABLE `tbl_informasi` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `katagori` varchar(50) NOT NULL,
  `pesan` text NOT NULL,
  `untukuser` varchar(50) NOT NULL,
  `tgl_informasi` datetime DEFAULT current_timestamp(),
  `status_info` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_informasi`
--

INSERT INTO `tbl_informasi` (`id`, `title`, `katagori`, `pesan`, `untukuser`, `tgl_informasi`, `status_info`) VALUES
(4, 'codeigniter', 'Artikel', 'Pandding metode phone', 'AdminKota', '2020-10-03 01:49:43', 1),
(5, 'telkomsel', 'Artikel', 'Pandding metode phone', 'Klien', '2020-10-03 01:55:27', 1),
(6, 'sdddd', 'Edukasi', 'sdsfd', 'UserIPWL', '2020-10-03 05:02:06', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_instansi`
--

CREATE TABLE `tbl_instansi` (
  `id_instansi` tinyint(1) NOT NULL,
  `institusi` varchar(150) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `status` varchar(150) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `kepsek` varchar(50) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `website` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `logo` varchar(250) NOT NULL,
  `id_user` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_instansi`
--

INSERT INTO `tbl_instansi` (`id_instansi`, `institusi`, `nama`, `status`, `alamat`, `kepsek`, `nip`, `website`, `email`, `logo`, `id_user`) VALUES
(1, 'Prov KEPRI', 'Sistem Informasi Rehabilitasi Rawat Jalan', 'Rehabilitasi', 'Jalan Hang Jebat KM.3, Batu Besar, Nongsa, Batu Besar, Kecamatan Nongsa, Kota Batam, Kepulauan Riau 29465', 'melly puspita', '-', 'https://batamkepri.com', 'imron@gmail.com', 'Logo_BNN_kepri.png', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jdl_kon_kelompok`
--

CREATE TABLE `tbl_jdl_kon_kelompok` (
  `id_jad_kon_kelompok` int(10) NOT NULL,
  `isi_jad_kelompok` mediumtext NOT NULL,
  `jam_acara_kelompok` varchar(100) NOT NULL,
  `batas_waktu` date NOT NULL,
  `id_surat` int(10) NOT NULL,
  `id_user` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_jdl_kon_kelompok`
--

INSERT INTO `tbl_jdl_kon_kelompok` (`id_jad_kon_kelompok`, `isi_jad_kelompok`, `jam_acara_kelompok`, `batas_waktu`, `id_surat`, `id_user`) VALUES
(7, 'kelompok', '08:00 Wib', '2020-10-01', 0, 1),
(9, 'cc', '08:00 Wib', '2020-10-01', 0, 1),
(10, 'kdkdkd\r\n', '10:00 Wib', '2020-10-01', 30, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jdl_kon_keluarga`
--

CREATE TABLE `tbl_jdl_kon_keluarga` (
  `id_jad_kon_keluarga` int(10) NOT NULL,
  `isi_jad_keluarga` mediumtext NOT NULL,
  `jam_acara` varchar(100) NOT NULL,
  `batas_waktu` date NOT NULL,
  `id_surat` int(10) NOT NULL,
  `id_user` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_jdl_kon_keluarga`
--

INSERT INTO `tbl_jdl_kon_keluarga` (`id_jad_kon_keluarga`, `isi_jad_keluarga`, `jam_acara`, `batas_waktu`, `id_surat`, `id_user`) VALUES
(2, 'kta konseling ya', '08:00 Wib', '2020-09-30', 33, 1),
(4, 'DDDDDD', '08:00 Wib', '2020-09-30', 0, 1),
(5, 'DF', '10:30 Wib', '2020-09-30', 0, 1),
(11, 'kkkk', '08:00 Wib', '2020-10-01', 30, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jenis_zat`
--

CREATE TABLE `tbl_jenis_zat` (
  `id_zat` int(10) NOT NULL,
  `nama_zat` varchar(50) NOT NULL,
  `tembakau` varchar(50) NOT NULL,
  `minuman_berakohol` varchar(50) NOT NULL,
  `kanabis` varchar(50) NOT NULL,
  `kokain` varchar(50) NOT NULL,
  `stimulant` varchar(50) NOT NULL,
  `inhalansia` varchar(50) NOT NULL,
  `sedaktiva_obti` varchar(50) NOT NULL,
  `halusinogens` varchar(50) NOT NULL,
  `opioida` varchar(50) NOT NULL,
  `zat_lain` varchar(50) NOT NULL,
  `id_surat` int(10) NOT NULL,
  `id_user` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_jenis_zat`
--

INSERT INTO `tbl_jenis_zat` (`id_zat`, `nama_zat`, `tembakau`, `minuman_berakohol`, `kanabis`, `kokain`, `stimulant`, `inhalansia`, `sedaktiva_obti`, `halusinogens`, `opioida`, `zat_lain`, `id_surat`, `id_user`) VALUES
(19, 'dfdf', 'Sedang', 'Berat', 'Berat', 'Sedang', 'Ringan', 'Ringan', 'Ringan', 'Ringan', '', 'Sedang', 33, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id_katego` tinyint(1) NOT NULL,
  `nama_katego` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_katego`, `nama_katego`) VALUES
(0, ''),
(1, 'HIV/AIDS'),
(2, 'TBC'),
(3, 'Sistem Saluran Pembuluh Darah'),
(4, 'Hepatitis B  '),
(5, 'Penyakit Kulit'),
(6, 'Hepatitis C'),
(7, 'Sistem Pernapasan'),
(8, 'Penyakit Lainnya'),
(9, 'Sistem Saluran Kandung Kemih'),
(10, 'Sistem Pencernaan'),
(20, 'Alkohol'),
(21, 'Barbiturat'),
(22, 'Cannabis'),
(23, 'Lebih dari 3 zat per hari (termasuk alcohol)'),
(24, 'Heroin'),
(25, 'Kokain'),
(26, 'Inhalan'),
(27, 'Metadin/Buprenofin'),
(28, 'Sedatif/Hinotik'),
(29, 'Halusinogen'),
(30, 'Opiat lain/Analgesik'),
(31, 'Amfetamin'),
(41, '0'),
(42, '1'),
(43, '2'),
(44, '3'),
(45, '4'),
(46, '5'),
(47, '6'),
(48, '7'),
(49, '8'),
(50, '9'),
(60, '1. Asesmen lanjutan / mendalam'),
(61, '2. Evaluasi Psikologis'),
(62, '3. Program Detoksifikasi'),
(63, '4. Wawancara Motivasional'),
(64, '5. Intervensi Singkat'),
(65, '6. Terapi Rumatan'),
(66, '7. Rehabilitasi rawat inap'),
(67, '8. Konseling'),
(68, '9. Lain-lain');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_klasifikasi`
--

CREATE TABLE `tbl_klasifikasi` (
  `id_klasifikasi` int(5) UNSIGNED NOT NULL,
  `kode` varchar(30) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `uraian` mediumtext NOT NULL,
  `kota` int(11) UNSIGNED NOT NULL,
  `id_user` tinyint(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_klasifikasi`
--

INSERT INTO `tbl_klasifikasi` (`id_klasifikasi`, `kode`, `nama`, `uraian`, `kota`, `id_user`) VALUES
(3, '004', 'Klink awalbros', 'Jalan Nongsa batam', 1, 1),
(4, '003', 'Klinik BNN Batam', 'Jl imperium batam', 2, 1),
(5, '002', 'Klink Kimia Farma batu aji', 'jln batu aji simpang lampu merah', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kota`
--

CREATE TABLE `tbl_kota` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_kota` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_kota`
--

INSERT INTO `tbl_kota` (`id`, `nama_kota`) VALUES
(1, 'Kabupaten Bintan'),
(2, 'Kabupaten Karimun'),
(3, 'Kabupaten Kepulauan Anambas'),
(4, 'Kabupaten Lingga'),
(5, 'Kabupaten Natuna'),
(6, 'Kota Batam'),
(7, 'Kota Tanjungpinang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_scrining`
--

CREATE TABLE `tbl_scrining` (
  `id_scrining` int(10) NOT NULL,
  `level_candu` varchar(250) NOT NULL,
  `isi_scrining` mediumtext NOT NULL,
  `jenis_zat` text NOT NULL,
  `pendidikan` text NOT NULL,
  `penyakit` text NOT NULL,
  `usia_pakai` varchar(12) NOT NULL,
  `jenis_zat_akhir` text NOT NULL,
  `id_surat` int(10) NOT NULL,
  `id_user` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_scrining`
--

INSERT INTO `tbl_scrining` (`id_scrining`, `level_candu`, `isi_scrining`, `jenis_zat`, `pendidikan`, `penyakit`, `usia_pakai`, `jenis_zat_akhir`, `id_surat`, `id_user`) VALUES
(50, 'Ringan', 'kakak', 'Alkohol,Lebih dari 3 zat per hari (termasuk alcohol)', 'imron', 'Sistem Saluran Pembuluh Darah', '23', 'TBC', 31, 1),
(51, 'Ringan', 'ada deh', 'Cannabis,Lebih dari 3 zat per hari (termasuk alcohol)', 'sma', 'Hepatitis C', '21', 'Heroin,Metadin/Buprenofin', 30, 1),
(55, 'Ringan', 'dd', 'Cannabis', 'ddd', 'TBC', 'dd', 'Barbiturat', 33, 1),
(57, 'Ringan', 'ddd', 'Sedatif/Hinotik', 'ddd', 'Penyakit Kulit', 'sdds', 'Kokain', 32, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_sett`
--

CREATE TABLE `tbl_sett` (
  `id_sett` tinyint(1) NOT NULL,
  `surat_masuk` tinyint(2) NOT NULL,
  `surat_keluar` tinyint(2) NOT NULL,
  `referensi` tinyint(2) NOT NULL,
  `id_user` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_sett`
--

INSERT INTO `tbl_sett` (`id_sett`, `surat_masuk`, `surat_keluar`, `referensi`, `id_user`) VALUES
(1, 5, 10, 10, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_slide`
--

CREATE TABLE `tbl_slide` (
  `id` int(11) NOT NULL,
  `nama_gambar` varchar(100) NOT NULL,
  `capstion` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_slide`
--

INSERT INTO `tbl_slide` (`id`, `nama_gambar`, `capstion`, `status`) VALUES
(1, 'img_nature_wide.jpg', 'Gambar Pertama Minimal 10', 1),
(2, 'img_snow_wide.jpg', 'Gambar Kedua 10 Kata', 1),
(3, 'img_mountains_wide.jpg', 'gambar 3 slide', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_surat_masuk`
--

CREATE TABLE `tbl_surat_masuk` (
  `id_surat` int(10) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `jenis_kelamin` text NOT NULL,
  `agama` varchar(50) NOT NULL,
  `status_perkawinan` varchar(20) NOT NULL,
  `pekerjaan` text NOT NULL,
  `kewarganegaraan` varchar(20) NOT NULL,
  `no_agenda` int(10) NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `asal_surat` varchar(250) NOT NULL,
  `isi` mediumtext NOT NULL,
  `kode` varchar(30) NOT NULL,
  `indeks` varchar(30) NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_diterima` date NOT NULL,
  `file` varchar(250) NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  `halo` int(11) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  `klinik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_surat_masuk`
--

INSERT INTO `tbl_surat_masuk` (`id_surat`, `nama`, `tempat_lahir`, `jenis_kelamin`, `agama`, `status_perkawinan`, `pekerjaan`, `kewarganegaraan`, `no_agenda`, `no_surat`, `asal_surat`, `isi`, `kode`, `indeks`, `tgl_surat`, `tgl_diterima`, `file`, `keterangan`, `halo`, `id_user`, `klinik`) VALUES
(28, 'Fajar Antono', 'Indramayu', 'Laki-laki', 'Islam', 'Menikah', 'IT Development', 'WNI', 2, '1', 'Jl', 'asasas', '082112066865', '999', '2020-09-11', '2020-09-11', '', 'asasasas', 344, 1, 0),
(29, 'tesrt', 'asas', 'Perempuan', 'Islam', 'Menikah', 'as', 'asas', 3, '11', 'Perempuan', 'sdsd', '11', '1', '2020-09-11', '2020-09-11', '', 'Suku Batak', 344, 4, 7),
(30, 'ahmad bayu', 'batam', 'Laki-laki', 'Islam', 'Menikah', 'pengusaha', 'indo', 4, '0823009021', 'batam', 'uji coba', '082388009021', '0823009021', '2020-08-26', '2020-09-12', '', 'uji coba', 123, 11, 7),
(31, 'rauf', 'rauf', 'Perempuan', 'Kristen Katolik', 'Menikah', 'rauf', 'rauf', 5, '9399393', 'rauf', 'rauf', '393939', '93939', '2020-09-14', '2020-09-14', '', 'Suku Sunda', 225, 1, 4),
(32, 'IMRON SIMANJUNTAK 3', 'simangalam', 'Laki-laki', 'Islam', 'Menikah', 'kpu', '082388009021', 6, '0823880090210', 'Jalan Kebahagian semu', 'polres', '082388009021', '082388009021', '1994-12-27', '2020-09-17', '5081-android_logo_PNG35.png', 'Suku Jawa', 123, 1, 3),
(33, 'nia', 'nia', 'nia', 'Islam', 'Menikah', 'nia', 'nia', 7, '123456', 'nia', 'nia', '123456', '123456', '2020-09-17', '2020-09-17', '4302-disposisiksn.jpg', 'Suku Jawa', 123, 11, 3),
(34, 'maulaan', 'adfkaskf', 'Perempuan', 'Islam', 'Lajang', 'adfasf', 'adfasf', 255584, '34123123123', 'adfaf', 'dikirim', '54545454', '12312312312', '2020-10-20', '2020-10-03', '7210-23287084_65210449-1366-43ec-b4e0-3f40296de95b_1080_1080.jpg', 'Suku Aceh', 344, 1, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` tinyint(2) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `kota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `nama`, `nip`, `admin`, `kota`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'Super Administrator', '-', 1, 2),
(2, 'kota1', 'e10adc3949ba59abbe56e057f20f883e', 'Admin Kota', '-', 2, 1),
(7, 'klinik', 'e10adc3949ba59abbe56e057f20f883e', 'User Klinik', '-', 3, 2),
(16, 'user', 'e10adc3949ba59abbe56e057f20f883e', 'nia', '-', 5, 20),
(17, 'dokter', 'e10adc3949ba59abbe56e057f20f883e', 'Dokter', 'JL. Menuju keberkahan', 4, 2),
(19, 'kota2', 'e10adc3949ba59abbe56e057f20f883e', 'Admin Kota', '-', 2, 3),
(20, '34123123123', '9a4a6fefef8d0a5503b3bdaa6b6c4cae', 'maulaan', '-', 5, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_wali_klien`
--

CREATE TABLE `tbl_wali_klien` (
  `id_wali` int(10) NOT NULL,
  `nama_wali` varchar(40) NOT NULL,
  `alamat_wali` mediumtext NOT NULL,
  `hubungan` varchar(100) NOT NULL,
  `tempat_lahir_wali` varchar(35) NOT NULL,
  `batas_waktu` date NOT NULL,
  `no_telp` varchar(25) NOT NULL,
  `nik` varchar(25) NOT NULL,
  `pekerjaan_wali` varchar(35) NOT NULL,
  `halo` int(11) NOT NULL,
  `id_surat` int(10) NOT NULL,
  `id_user` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_wali_klien`
--

INSERT INTO `tbl_wali_klien` (`id_wali`, `nama_wali`, `alamat_wali`, `hubungan`, `tempat_lahir_wali`, `batas_waktu`, `no_telp`, `nik`, `pekerjaan_wali`, `halo`, `id_surat`, `id_user`) VALUES
(16, 'DINO', 'JL SAMA', 'Abang Kandung', '', '2020-09-08', '08230000000000', '', '', 123, 22, 1),
(17, 'Farras Sidqi', 'Jl. Farra Dina Asyfa No. 4', 'Adik Kandung', '', '2020-09-08', '08230000000000', '', '', 225, 22, 1),
(19, 'nama wali', '24234234', 'Ibu', 'SFASFAS', '2020-10-03', '23423423423', 'SAFASDFAS', 'SADFSFSF', 344, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_asesmen`
--
ALTER TABLE `tbl_asesmen`
  ADD PRIMARY KEY (`id_asesmen`);

--
-- Indeks untuk tabel `tbl_disposisi`
--
ALTER TABLE `tbl_disposisi`
  ADD PRIMARY KEY (`id_disposisi`);

--
-- Indeks untuk tabel `tbl_informasi`
--
ALTER TABLE `tbl_informasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_instansi`
--
ALTER TABLE `tbl_instansi`
  ADD PRIMARY KEY (`id_instansi`);

--
-- Indeks untuk tabel `tbl_jdl_kon_kelompok`
--
ALTER TABLE `tbl_jdl_kon_kelompok`
  ADD PRIMARY KEY (`id_jad_kon_kelompok`);

--
-- Indeks untuk tabel `tbl_jdl_kon_keluarga`
--
ALTER TABLE `tbl_jdl_kon_keluarga`
  ADD PRIMARY KEY (`id_jad_kon_keluarga`);

--
-- Indeks untuk tabel `tbl_jenis_zat`
--
ALTER TABLE `tbl_jenis_zat`
  ADD PRIMARY KEY (`id_zat`);

--
-- Indeks untuk tabel `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id_katego`);

--
-- Indeks untuk tabel `tbl_klasifikasi`
--
ALTER TABLE `tbl_klasifikasi`
  ADD PRIMARY KEY (`id_klasifikasi`);

--
-- Indeks untuk tabel `tbl_kota`
--
ALTER TABLE `tbl_kota`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_scrining`
--
ALTER TABLE `tbl_scrining`
  ADD PRIMARY KEY (`id_scrining`);

--
-- Indeks untuk tabel `tbl_sett`
--
ALTER TABLE `tbl_sett`
  ADD PRIMARY KEY (`id_sett`);

--
-- Indeks untuk tabel `tbl_slide`
--
ALTER TABLE `tbl_slide`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_surat_masuk`
--
ALTER TABLE `tbl_surat_masuk`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `tbl_wali_klien`
--
ALTER TABLE `tbl_wali_klien`
  ADD PRIMARY KEY (`id_wali`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_asesmen`
--
ALTER TABLE `tbl_asesmen`
  MODIFY `id_asesmen` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `tbl_disposisi`
--
ALTER TABLE `tbl_disposisi`
  MODIFY `id_disposisi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `tbl_informasi`
--
ALTER TABLE `tbl_informasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_jdl_kon_kelompok`
--
ALTER TABLE `tbl_jdl_kon_kelompok`
  MODIFY `id_jad_kon_kelompok` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tbl_jdl_kon_keluarga`
--
ALTER TABLE `tbl_jdl_kon_keluarga`
  MODIFY `id_jad_kon_keluarga` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tbl_jenis_zat`
--
ALTER TABLE `tbl_jenis_zat`
  MODIFY `id_zat` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `tbl_klasifikasi`
--
ALTER TABLE `tbl_klasifikasi`
  MODIFY `id_klasifikasi` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_kota`
--
ALTER TABLE `tbl_kota`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_scrining`
--
ALTER TABLE `tbl_scrining`
  MODIFY `id_scrining` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT untuk tabel `tbl_slide`
--
ALTER TABLE `tbl_slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_surat_masuk`
--
ALTER TABLE `tbl_surat_masuk`
  MODIFY `id_surat` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tbl_wali_klien`
--
ALTER TABLE `tbl_wali_klien`
  MODIFY `id_wali` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
