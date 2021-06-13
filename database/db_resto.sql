# Host: localhost  (Version: 5.6.24)
# Date: 2016-03-02 16:13:46
# Generator: MySQL-Front 5.3  (Build 4.271)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "tb_bahanbaku"
#

DROP TABLE IF EXISTS `tb_bahanbaku`;
CREATE TABLE `tb_bahanbaku` (
  `kd_bahan` int(11) NOT NULL AUTO_INCREMENT,
  `nm_bhn` varchar(50) NOT NULL DEFAULT '0',
  `opname` int(11) DEFAULT NULL,
  `stok` int(10) NOT NULL,
  `harga_awal` double(5,0) DEFAULT NULL,
  `satuan` varchar(50) NOT NULL,
  `tgl` date DEFAULT NULL,
  `ket` text NOT NULL,
  PRIMARY KEY (`kd_bahan`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# Data for table "tb_bahanbaku"
#

INSERT INTO `tb_bahanbaku` VALUES (1,'Bawang',100,99,5000,'gram','2016-02-16','');

#
# Structure for table "tb_bungkus"
#

DROP TABLE IF EXISTS `tb_bungkus`;
CREATE TABLE `tb_bungkus` (
  `nota` varchar(50) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `tgl` date NOT NULL,
  `jam` time NOT NULL,
  `nip` varchar(10) NOT NULL,
  `gtot` double(10,0) NOT NULL,
  `sts` varchar(10) DEFAULT NULL,
  `bayar` double(10,0) NOT NULL,
  `trans` varchar(1) DEFAULT NULL,
  `tgl_tutup` date DEFAULT NULL,
  `tutup` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "tb_bungkus"
#

INSERT INTO `tb_bungkus` VALUES ('BKS344','','2016-03-02','11:35:04','kasir',15000,'sudah',15000,'Y',NULL,'T');

#
# Structure for table "tb_customer"
#

DROP TABLE IF EXISTS `tb_customer`;
CREATE TABLE `tb_customer` (
  `Id_cus` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `nohp` varchar(30) NOT NULL,
  `nota` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id_cus`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

#
# Data for table "tb_customer"
#

INSERT INTO `tb_customer` VALUES (1,'Yesy','654987321','N201602280402430'),(2,'Pelanggan T001','0193819','N201602280402330'),(3,'Pemesan 1','123456789','N201603010703040'),(4,'Pelanggan 1','321','N201603010203160'),(5,'Saya','857859213','N201603020703070'),(6,'Hillag','987654321','N201603020703440'),(7,'uus','321654987','N201603021003520'),(8,'Rudi','654987','N201603021003190');

#
# Structure for table "tb_det_bahanbaku"
#

DROP TABLE IF EXISTS `tb_det_bahanbaku`;
CREATE TABLE `tb_det_bahanbaku` (
  `kd_bhn` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `stok_msk` int(10) NOT NULL,
  `stok_klr` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "tb_det_bahanbaku"
#


#
# Structure for table "tb_det_bungkus"
#

DROP TABLE IF EXISTS `tb_det_bungkus`;
CREATE TABLE `tb_det_bungkus` (
  `nota` varchar(50) NOT NULL,
  `kd_item` int(11) NOT NULL,
  `jml` int(20) NOT NULL,
  `ket` text NOT NULL,
  `sts` varchar(20) DEFAULT 'belum',
  `tgl_tutup` date DEFAULT NULL,
  `tutup` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "tb_det_bungkus"
#

INSERT INTO `tb_det_bungkus` VALUES ('BKS344',5,1,'','sudah',NULL,NULL);

#
# Structure for table "tb_det_pesan"
#

DROP TABLE IF EXISTS `tb_det_pesan`;
CREATE TABLE `tb_det_pesan` (
  `nota` varchar(50) NOT NULL,
  `kd_item` int(11) NOT NULL,
  `jml` int(20) NOT NULL,
  `rasa` varchar(10) DEFAULT '-',
  `ket` text NOT NULL,
  `sts` varchar(20) DEFAULT 'belum'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "tb_det_pesan"
#

INSERT INTO `tb_det_pesan` VALUES ('N201602280402430',2,1,NULL,'','sudah'),('N201602280402430',9,1,NULL,'','sudah'),('N201602280402330',13,1,'Coklat','','sudah'),('N201602280402330',14,1,'Manis','','sudah'),('N201602280402330',8,1,NULL,'','sudah'),('N201603010703040',3,1,NULL,'','sudah'),('N201603010703040',8,1,NULL,'','sudah'),('N201603010703040',9,1,'','','sudah'),('N201603010203160',3,1,NULL,'','sudah'),('N201603010203160',9,1,NULL,'','sudah'),('N201603020703070',3,1,NULL,'','sudah'),('N201603020703440',4,1,NULL,'','sudah'),('N201603020703440',13,1,'Coklat','','sudah'),('N201603020703440',7,1,NULL,'','sudah'),('N201603020703440',8,1,NULL,'','sudah'),('N201603021003520',13,1,'Coklat','','sudah'),('N201603021003190',5,1,NULL,'','sudah'),('N201603021003190',12,1,NULL,'','sudah'),('N201603021003190',9,1,NULL,'','sudah'),('N201603021003190',8,1,NULL,'','sudah'),('N201603021003190',4,2,NULL,'','sudah');

#
# Structure for table "tb_item"
#

DROP TABLE IF EXISTS `tb_item`;
CREATE TABLE `tb_item` (
  `kd_item` int(11) NOT NULL AUTO_INCREMENT,
  `item` varchar(50) NOT NULL,
  `stok` int(11) DEFAULT '0',
  `kd_jenis` int(11) NOT NULL DEFAULT '0',
  `rasa` varchar(50) DEFAULT NULL,
  `item_jadi` varchar(10) DEFAULT NULL,
  `harga` double(10,0) NOT NULL,
  `promo` int(11) DEFAULT '0',
  `populer` varchar(1) DEFAULT 'T',
  `ket` text NOT NULL,
  `foto` varchar(50) NOT NULL,
  `sts` varchar(20) DEFAULT 'habis',
  `pilihan` varchar(1) DEFAULT 'T',
  PRIMARY KEY (`kd_item`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

#
# Data for table "tb_item"
#

INSERT INTO `tb_item` VALUES (1,'Indian Recipes',0,1,',','Tidak',15000,2,'T','Aenean nonummy hendrerit \r\nauris. Phasellus porta. Fusce suscipit varius mi Cum sociis penatibus.','','Tidak','T'),(2,'Sausage Recipes',0,1,',','Tidak',15000,0,'Y','Aenean nonummy hendrerit mauris. Phasellus porta. Fusce suscipit varius mi Cum sociis penatibus.','','ada','T'),(3,'Peach Salsa',0,1,',','Tidak',15000,0,'Y','Aenean nonummy hendrerit mauris. Phasellus porta. Fusce suscipit varius mi Cum sociis penatibus.','','ada','T'),(4,'Fish Meal',0,1,',','Tidak',15000,0,'Y','Aenean nonummy hendrerit mauris. Phasellus porta. Fusce suscipit varius mi Cum sociis penatibus.','','ada','T'),(5,'Bruschetta Bread',0,1,',','Tidak',15000,0,'Y','Aenean nonummy hendrerit mauris. Phasellus porta. Fusce suscipit varius mi Cum sociis penatibus.','','ada','T'),(6,'Italian Recipes',0,1,',','Tidak',15000,0,'Y','Aenean nonummy hendrerit mauris. Phasellus porta. Fusce suscipit varius mi Cum sociis penatibus.','','ada','T'),(7,'Lemon Tea',0,2,',','Tidak',7000,0,'T','','','ada','T'),(8,'Tea Es',0,2,',','Tidak',7000,4,'Y','','','ada','T'),(9,'Color Es',0,2,',','Tidak',7000,0,'Y','','','ada','T'),(10,'White Cofee',0,2,',','Ya',1200,0,'T','','','Tidak','T'),(11,'Torabika Cappucino',7,2,',','Ya',4000,0,'T','','','ada','T'),(12,'Nasi Maknyus',0,1,',','Tidak',15000,0,'T','','','ada','T'),(13,'Roti Bakar',0,1,'Coklat,Strawberry,Keju,Jelly','Tidak',7500,5,'T','Aenean nonummy hendrerit \r\nauris. Phasellus porta. Fusce suscipit varius mi Cum sociis penatibus.','','ada','Y'),(14,'Jagung Bakar',0,1,'Pedas,Manis,Asin','Tidak',7500,0,'T','Aenean nonummy hendrerit auris. Phasellus porta. Fusce suscipit varius mi Cum sociis penatibus.','','ada','Y');

#
# Structure for table "tb_jenis"
#

DROP TABLE IF EXISTS `tb_jenis`;
CREATE TABLE `tb_jenis` (
  `kd_jns` int(11) NOT NULL AUTO_INCREMENT,
  `nm_jns` varchar(50) NOT NULL,
  PRIMARY KEY (`kd_jns`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Data for table "tb_jenis"
#

INSERT INTO `tb_jenis` VALUES (1,'Makanan'),(2,'Minuman ');

#
# Structure for table "tb_karyawan"
#

DROP TABLE IF EXISTS `tb_karyawan`;
CREATE TABLE `tb_karyawan` (
  `nip` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jabat` varchar(25) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `foto` varchar(20) NOT NULL,
  `sts` varchar(1) DEFAULT 'A',
  PRIMARY KEY (`nip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "tb_karyawan"
#


#
# Structure for table "tb_meja"
#

DROP TABLE IF EXISTS `tb_meja`;
CREATE TABLE `tb_meja` (
  `id_meja` int(11) NOT NULL AUTO_INCREMENT,
  `nm_meja` varchar(30) NOT NULL,
  `lantai` varchar(20) NOT NULL,
  `sts` varchar(20) NOT NULL DEFAULT 'kosong',
  PRIMARY KEY (`id_meja`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

#
# Data for table "tb_meja"
#

INSERT INTO `tb_meja` VALUES (1,'L001','Lantai 1','kosong'),(2,'T001','Lantai 2','kosong'),(4,'T002','Lantai 1','kosong'),(5,'T003','Lantai 1','kosong'),(6,'T004','Lantai 1','kosong'),(7,'T005','Lantai 1','kosong'),(8,'T006','Lantai 1','kosong'),(9,'T007','Lantai 1','kosong'),(10,'BKS','Lantai 1','Ada');

#
# Structure for table "tb_menu"
#

DROP TABLE IF EXISTS `tb_menu`;
CREATE TABLE `tb_menu` (
  `id_menu` int(2) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `urutan` int(2) DEFAULT NULL,
  `link` varchar(50) DEFAULT NULL,
  `level` varchar(20) DEFAULT NULL,
  `aktif` varchar(10) DEFAULT 'tidak',
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

#
# Data for table "tb_menu"
#

INSERT INTO `tb_menu` VALUES (2,'Daftar Item',3,'#','admin,,','ya'),(3,'Daftar Karyawan',2,'#','admin,','ya'),(4,'Data Bahan Baku',4,'#','admin,','ya'),(5,'Pengaturan',7,'#','admin,kasir,','ya'),(6,'Menu Utama',1,'adashboard','admin,kasir,','ya'),(7,'Transaksi',5,'#','kasir,','ya'),(8,'Jatah Karyawan',6,'#','kasir,','ya'),(14,'Menu',8,'#','admin,','ya'),(15,'Divisi Dapur',8,'apesanan','admin,','tidak'),(16,'Rekap Penjualan',7,'#','admin,','ya'),(17,'History Pesanan',6,'#','admin,kasir,','ya'),(18,'Pesanan Bungkus',2,'apesanan/bungkus','Chef,','ya'),(19,'Pesanan Transaksi',1,'apesanan','Chef,','ya');

#
# Structure for table "tb_pemesanan"
#

DROP TABLE IF EXISTS `tb_pemesanan`;
CREATE TABLE `tb_pemesanan` (
  `nota` varchar(50) NOT NULL,
  `kd_item` int(11) NOT NULL,
  `rasa` varchar(20) DEFAULT NULL,
  `jml` int(20) NOT NULL,
  `ket` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "tb_pemesanan"
#


#
# Structure for table "tb_perusahaan"
#

DROP TABLE IF EXISTS `tb_perusahaan`;
CREATE TABLE `tb_perusahaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `almt` varchar(100) NOT NULL,
  `kota` varchar(40) NOT NULL,
  `telp` varchar(30) NOT NULL DEFAULT '0',
  `foto` varchar(50) NOT NULL,
  `ket` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# Data for table "tb_perusahaan"
#

INSERT INTO `tb_perusahaan` VALUES (1,'Teras Panglima','Jl.Simpang Ijen no.05','Malang','0341-711737','','Toko ini memiliki beberapa cabang. Berkunjunglah ke resto ini\r\n');

#
# Structure for table "tb_pesan"
#

DROP TABLE IF EXISTS `tb_pesan`;
CREATE TABLE `tb_pesan` (
  `nota` varchar(50) NOT NULL,
  `id_meja` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `jam` time NOT NULL,
  `nip` varchar(20) NOT NULL DEFAULT '',
  `id_cus` int(11) NOT NULL,
  `gtot` double(10,0) NOT NULL DEFAULT '0',
  `bayar` double(10,0) DEFAULT '0',
  `sts` varchar(20) DEFAULT 'belum',
  `trans` varchar(1) NOT NULL DEFAULT 'T',
  `tgl_tutup` date DEFAULT NULL,
  `tutup` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "tb_pesan"
#

INSERT INTO `tb_pesan` VALUES ('N201602280402430',1,'2016-02-28','04:40:43','',1,22000,23000,'sudah','Y','2016-02-28','Y'),('N201602280402330',2,'2016-02-28','04:45:33','',2,21345,22000,'sudah','Y','2016-02-28','Y'),('N201603010703040',2,'2016-03-01','07:31:04','',3,28720,30000,'sudah','Y','2016-02-28','Y'),('N201603010203160',1,'2016-03-01','02:14:16','',4,22000,23000,'sudah','Y',NULL,'T'),('N201603020703070',2,'2016-03-02','07:26:07','',5,15000,20000,'sudah','Y',NULL,'T'),('N201603020703440',5,'2016-03-02','07:58:44','',6,35845,40000,'sudah','Y',NULL,'T'),('N201603021003520',4,'2016-03-02','10:05:52','',7,7125,8000,'sudah','Y',NULL,'T'),('N201603021003190',6,'2016-03-02','10:12:19','',8,73720,80000,'sudah','Y',NULL,'T');

#
# Structure for table "tb_pesan_bungkus"
#

DROP TABLE IF EXISTS `tb_pesan_bungkus`;
CREATE TABLE `tb_pesan_bungkus` (
  `nota` varchar(50) NOT NULL,
  `tgl` date NOT NULL,
  `jam` time NOT NULL,
  `gtot` double(10,0) NOT NULL,
  `sts` varchar(20) DEFAULT 'belum',
  `trans` varchar(1) NOT NULL DEFAULT 'T'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "tb_pesan_bungkus"
#


#
# Structure for table "tb_prive"
#

DROP TABLE IF EXISTS `tb_prive`;
CREATE TABLE `tb_prive` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `userkasir` varchar(50) DEFAULT NULL,
  `nip` varchar(20) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `kd_item` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "tb_prive"
#


#
# Structure for table "tb_submenu"
#

DROP TABLE IF EXISTS `tb_submenu`;
CREATE TABLE `tb_submenu` (
  `id_sub` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) DEFAULT NULL,
  `menu_sub` varchar(50) DEFAULT NULL,
  `urutan` int(2) DEFAULT NULL,
  `link` varchar(100) DEFAULT 'welcome',
  `level` varchar(30) DEFAULT NULL,
  `aktif` varchar(10) DEFAULT 'tidak',
  PRIMARY KEY (`id_sub`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

#
# Data for table "tb_submenu"
#

INSERT INTO `tb_submenu` VALUES (1,3,'Karyawan Aktif',1,'akaryawan','admin','ya'),(2,3,'Semua Karyawan',1,'akaryawan/all','admin','ya'),(3,2,'Data Item dan Jenis',1,'aitem','admin','ya'),(4,4,'Input Bahan Baru',1,'abahanbaku','admin','ya'),(5,5,'Pengaturan Resto',3,'aperusahaan','admin','ya'),(6,5,'Ganti Password',8,'adminweb/password','admin,kasir,Chef,','ya'),(7,5,'Pengaturan User',1,'auser','admin','ya'),(8,5,'Pengaturan Meja',2,'ameja','admin','ya'),(9,7,'Transaksi Pembayaran',8,'akasir/transaksi','admin,kasir,','ya'),(10,7,'Transaksi Bawa Pulang',4,'akasir/bawapulang','kasir,admin','ya'),(11,7,'Tambah Item',1,'akasir/tambahitem','kasir,admin','ya'),(12,17,'History Semua Transaksi',1,'adminweb/historytrans','admin,kasir,','ya'),(15,14,'Setting Menu',1,'amenu','admin,','ya'),(16,8,'History Prive',1,'akaryawan/historyprive','admin,','ya'),(17,8,'Input Jatah Karyawan',1,'akaryawan/prive','admin,kasir,','ya'),(18,14,'Setting Submenu',8,'amenu/submenu','admin,','tidak'),(19,16,'Grafik Penjualan',1,'agrafik','admin,','ya'),(20,4,'History Stok',9,'abahanbaku/view_his','admin,','ya'),(21,16,'History Keuangan',3,'adminweb/historypenjualan','admin,','ya'),(22,17,'History Pesanan Hari ini',8,'akasir/historypesanan','admin,kasir,','ya'),(23,17,'History Bungkus',3,'akasir/historybungkus','admin,kasir,','ya'),(24,16,'Grafik Bungkus',2,'agrafik/penjualanbungkus','admin,','ya');

#
# Structure for table "tb_user"
#

DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `pass` text,
  `nama` varchar(50) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `level` varchar(10) DEFAULT NULL,
  `blokir` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

#
# Data for table "tb_user"
#

INSERT INTO `tb_user` VALUES (1,'admin','0192023a7bbd73250516f069df18b500','Admin','123456','Admin','N'),(7,'koki','c38be0f1f87d0e77a0cd2fe6941253eb','koki','123456','Chef','N'),(8,'kasir','c7911af3adbd12a035b289556d96470a','kasir','123456','Kasir','N');

#
# Structure for table "q_det_jenis"
#

DROP VIEW IF EXISTS `q_det_jenis`;
CREATE VIEW `q_det_jenis` AS 
  select `tb_jenis`.`nm_jns` AS `nm_jns`,`tb_det_pesan`.`jml` AS `jml` from ((`tb_det_pesan` join `tb_item` on((`tb_item`.`kd_item` = `tb_det_pesan`.`kd_item`))) join `tb_jenis` on((`tb_item`.`kd_jenis` = `tb_jenis`.`kd_jns`)));

#
# Structure for table "q_det_pesan"
#

DROP VIEW IF EXISTS `q_det_pesan`;
CREATE VIEW `q_det_pesan` AS 
  select `tb_det_pesan`.`nota` AS `nota`,`tb_item`.`item` AS `item`,`tb_item`.`harga` AS `harga`,`tb_det_pesan`.`jml` AS `jml`,`tb_det_pesan`.`ket` AS `ket`,`tb_pesan`.`gtot` AS `gtot`,`tb_jenis`.`nm_jns` AS `nm_jns`,`tb_pesan`.`tgl` AS `tgl`,`tb_pesan`.`jam` AS `jam`,`tb_pesan`.`bayar` AS `bayar`,`tb_item`.`promo` AS `promo`,`tb_pesan`.`tgl_tutup` AS `tgl_tutup`,`tb_pesan`.`tutup` AS `tutup`,`tb_det_pesan`.`kd_item` AS `kd_item`,`tb_item`.`rasa` AS `rasa` from (((`tb_det_pesan` join `tb_item` on((`tb_det_pesan`.`kd_item` = `tb_item`.`kd_item`))) join `tb_pesan` on((`tb_det_pesan`.`nota` = `tb_pesan`.`nota`))) join `tb_jenis` on((`tb_jenis`.`kd_jns` = `tb_item`.`kd_jenis`)));

#
# Structure for table "q_his_bahan"
#

DROP VIEW IF EXISTS `q_his_bahan`;
CREATE VIEW `q_his_bahan` AS 
  select `tb_det_bahanbaku`.`kd_bhn` AS `kd_bhn`,`tb_bahanbaku`.`nm_bhn` AS `nm_bhn`,`tb_det_bahanbaku`.`tgl` AS `tgl`,`tb_det_bahanbaku`.`stok_msk` AS `stok_msk`,`tb_det_bahanbaku`.`stok_klr` AS `stok_klr`,`tb_bahanbaku`.`stok` AS `stok`,`tb_bahanbaku`.`opname` AS `opname` from (`tb_bahanbaku` join `tb_det_bahanbaku` on((`tb_bahanbaku`.`kd_bahan` = `tb_det_bahanbaku`.`kd_bhn`)));

#
# Structure for table "q_his_trans"
#

DROP VIEW IF EXISTS `q_his_trans`;
CREATE VIEW `q_his_trans` AS 
  select `tb_pesan`.`nota` AS `nota`,`tb_meja`.`nm_meja` AS `nm_meja`,`tb_pesan`.`tgl` AS `tgl`,`tb_pesan`.`jam` AS `jam`,`tb_customer`.`nama` AS `nama`,`tb_pesan`.`sts` AS `sts` from ((`tb_pesan` join `tb_customer` on((`tb_customer`.`Id_cus` = `tb_pesan`.`id_cus`))) join `tb_meja` on((`tb_pesan`.`id_meja` = `tb_meja`.`id_meja`)));

#
# Structure for table "q_item"
#

DROP VIEW IF EXISTS `q_item`;
CREATE VIEW `q_item` AS 
  select `tb_jenis`.`nm_jns` AS `nm_jns`,`tb_item`.`kd_item` AS `kd_item`,`tb_item`.`item` AS `item`,`tb_item`.`stok` AS `stok`,`tb_item`.`item_jadi` AS `item_jadi`,`tb_item`.`harga` AS `harga`,`tb_item`.`promo` AS `promo`,`tb_item`.`populer` AS `populer`,`tb_item`.`sts` AS `sts`,`tb_item`.`ket` AS `ket`,`tb_item`.`pilihan` AS `pilihan`,`tb_item`.`kd_jenis` AS `kd_jenis`,`tb_item`.`rasa` AS `rasa` from (`tb_jenis` join `tb_item` on((`tb_item`.`kd_jenis` = `tb_jenis`.`kd_jns`)));

#
# Structure for table "q_jml_perhari"
#

DROP VIEW IF EXISTS `q_jml_perhari`;
CREATE VIEW `q_jml_perhari` AS 
  select `tb_item`.`item` AS `item`,sum(`tb_det_pesan`.`jml`) AS `Sum_jml`,`tb_pesan`.`tgl` AS `tgl`,`tb_det_pesan`.`sts` AS `sts`,`tb_jenis`.`nm_jns` AS `nm_jns`,`tb_pesan`.`tutup` AS `tutup` from ((((`tb_item` join `tb_det_pesan` on((`tb_item`.`kd_item` = `tb_det_pesan`.`kd_item`))) join `tb_pesan` on((`tb_pesan`.`nota` = `tb_det_pesan`.`nota`))) join `tb_jenis` on((`tb_item`.`kd_jenis` = `tb_jenis`.`kd_jns`))) join `tb_meja` on((`tb_meja`.`id_meja` = `tb_pesan`.`id_meja`))) group by `tb_item`.`item`,`tb_pesan`.`tgl`,`tb_det_pesan`.`sts`,`tb_jenis`.`nm_jns`,`tb_pesan`.`tutup`;

#
# Structure for table "q_jml_perhari_bungkus"
#

DROP VIEW IF EXISTS `q_jml_perhari_bungkus`;
CREATE VIEW `q_jml_perhari_bungkus` AS 
  select `tb_item`.`item` AS `item`,sum(`tb_det_bungkus`.`jml`) AS `jml`,`tb_bungkus`.`tutup` AS `tutup`,`tb_bungkus`.`tgl` AS `tgl` from ((`tb_det_bungkus` join `tb_item` on((`tb_item`.`kd_item` = `tb_det_bungkus`.`kd_item`))) join `tb_bungkus` on((`tb_bungkus`.`nota` = `tb_det_bungkus`.`nota`))) group by `tb_item`.`item`,`tb_bungkus`.`tutup`,`tb_bungkus`.`tgl`;

#
# Structure for table "q_laporan_hari"
#

DROP VIEW IF EXISTS `q_laporan_hari`;
CREATE VIEW `q_laporan_hari` AS 
  select `tb_pesan`.`nota` AS `nota`,`tb_pesan`.`tgl` AS `tgl`,`tb_item`.`item` AS `item`,`tb_det_pesan`.`jml` AS `jml`,`tb_pesan`.`gtot` AS `gtot`,`tb_pesan`.`bayar` AS `bayar`,`tb_pesan`.`tutup` AS `tutup`,`tb_pesan`.`tgl_tutup` AS `tgl_tutup`,`tb_pesan`.`jam` AS `jam`,`tb_pesan`.`trans` AS `trans` from ((`tb_pesan` join `tb_det_pesan` on((`tb_pesan`.`nota` = `tb_det_pesan`.`nota`))) join `tb_item` on((`tb_det_pesan`.`kd_item` = `tb_item`.`kd_item`)));

#
# Structure for table "q_masuklagi"
#

DROP VIEW IF EXISTS `q_masuklagi`;
CREATE VIEW `q_masuklagi` AS 
  select `tb_pesan`.`tgl` AS `tgl`,`tb_pesan`.`jam` AS `jam`,`tb_customer`.`nama` AS `nama`,`tb_customer`.`nohp` AS `nohp`,`tb_pesan`.`nota` AS `nota` from (`tb_customer` join `tb_pesan` on((`tb_customer`.`Id_cus` = `tb_pesan`.`id_cus`)));

#
# Structure for table "q_pemesanan"
#

DROP VIEW IF EXISTS `q_pemesanan`;
CREATE VIEW `q_pemesanan` AS 
  select `tb_pemesanan`.`kd_item` AS `kd_item`,`tb_item`.`item` AS `item`,`tb_item`.`harga` AS `harga`,`tb_pemesanan`.`jml` AS `jml`,`tb_pemesanan`.`ket` AS `ket`,`tb_pemesanan`.`nota` AS `nota`,`tb_item`.`promo` AS `promo`,`tb_pemesanan`.`rasa` AS `rasa` from (`tb_pemesanan` join `tb_item` on((`tb_item`.`kd_item` = `tb_pemesanan`.`kd_item`)));

#
# Structure for table "q_pesan"
#

DROP VIEW IF EXISTS `q_pesan`;
CREATE VIEW `q_pesan` AS 
  select `tb_det_pesan`.`nota` AS `nota`,`tb_item`.`item` AS `item`,`tb_det_pesan`.`jml` AS `jml`,`tb_det_pesan`.`ket` AS `ket`,`tb_pesan`.`sts` AS `sts`,`tb_pesan`.`tgl` AS `tgl`,`tb_pesan`.`jam` AS `jam`,`tb_meja`.`nm_meja` AS `nm_meja`,`tb_det_pesan`.`sts` AS `sts_item`,`tb_det_pesan`.`rasa` AS `rasa`,`tb_det_pesan`.`kd_item` AS `kd_item` from (((`tb_det_pesan` join `tb_item` on((`tb_item`.`kd_item` = `tb_det_pesan`.`kd_item`))) join `tb_pesan` on((`tb_pesan`.`nota` = `tb_det_pesan`.`nota`))) join `tb_meja` on((`tb_pesan`.`id_meja` = `tb_meja`.`id_meja`)));

#
# Structure for table "q_pesan_bungkus"
#

DROP VIEW IF EXISTS `q_pesan_bungkus`;
CREATE VIEW `q_pesan_bungkus` AS 
  select `tb_bungkus`.`nota` AS `nota`,`tb_bungkus`.`nama` AS `nama`,`tb_bungkus`.`tgl` AS `tgl`,`tb_bungkus`.`jam` AS `jam`,`tb_item`.`item` AS `item`,`tb_jenis`.`nm_jns` AS `nm_jns`,`tb_det_bungkus`.`sts` AS `sts_item`,`tb_bungkus`.`sts` AS `sts`,`tb_det_bungkus`.`jml` AS `jml`,`tb_det_bungkus`.`ket` AS `ket`,`tb_bungkus`.`tgl_tutup` AS `tgl_tutup`,`tb_bungkus`.`tutup` AS `tutup`,`tb_det_bungkus`.`kd_item` AS `kd_item` from (((`tb_det_bungkus` join `tb_bungkus` on((`tb_bungkus`.`nota` = `tb_det_bungkus`.`nota`))) join `tb_item` on((`tb_det_bungkus`.`kd_item` = `tb_item`.`kd_item`))) join `tb_jenis` on((`tb_item`.`kd_jenis` = `tb_jenis`.`kd_jns`)));

#
# Structure for table "q_prive"
#

DROP VIEW IF EXISTS `q_prive`;
CREATE VIEW `q_prive` AS 
  select `tb_prive`.`userkasir` AS `userkasir`,`tb_karyawan`.`nama` AS `nama`,`tb_prive`.`tgl` AS `tgl`,`tb_prive`.`jam` AS `jam`,`tb_item`.`item` AS `item` from ((`tb_prive` join `tb_karyawan` on((`tb_prive`.`nip` = `tb_karyawan`.`nip`))) join `tb_item` on((`tb_item`.`kd_item` = `tb_prive`.`kd_item`)));

#
# Structure for table "q_submenu"
#

DROP VIEW IF EXISTS `q_submenu`;
CREATE VIEW `q_submenu` AS 
  select `tb_submenu`.`menu_sub` AS `menu_sub`,`tb_menu`.`nama` AS `nama`,`tb_submenu`.`link` AS `link`,`tb_submenu`.`level` AS `level`,`tb_submenu`.`aktif` AS `aktif`,`tb_submenu`.`urutan` AS `urutan`,`tb_submenu`.`id_sub` AS `id_sub` from (`tb_menu` join `tb_submenu` on((`tb_submenu`.`id_menu` = `tb_menu`.`id_menu`)));

#
# Structure for table "q_trans_sudah"
#

DROP VIEW IF EXISTS `q_trans_sudah`;
CREATE VIEW `q_trans_sudah` AS 
  select `tb_pesan`.`nota` AS `nota`,`tb_meja`.`nm_meja` AS `nm_meja`,`tb_pesan`.`gtot` AS `gtot`,`tb_pesan`.`sts` AS `sts`,`tb_pesan`.`trans` AS `trans`,`tb_customer`.`nama` AS `nama`,`tb_pesan`.`tgl` AS `tgl`,`tb_pesan`.`jam` AS `jam` from ((`tb_pesan` join `tb_meja` on((`tb_pesan`.`id_meja` = `tb_meja`.`id_meja`))) join `tb_customer` on((`tb_pesan`.`id_cus` = `tb_customer`.`Id_cus`)));
