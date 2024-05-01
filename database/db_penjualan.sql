# Host: localhost  (Version: 5.6.20)
# Date: 2023-01-30 21:56:21
# Generator: MySQL-Front 5.2  (Build 5.66)

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE */;
/*!40101 SET SQL_MODE='NO_ENGINE_SUBSTITUTION' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES */;
/*!40103 SET SQL_NOTES='ON' */;

CREATE DATABASE `db_penjualan` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_penjualan`;

#
# Source for table "dtl_penjualan"
#

CREATE TABLE `dtl_penjualan` (
  `kd_nota` char(10) NOT NULL DEFAULT '',
  `kd_sukucadang` char(5) DEFAULT NULL,
  `jml_jual` int(3) DEFAULT NULL,
  `hrg_jual` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "dtl_penjualan"
#

INSERT INTO `dtl_penjualan` VALUES ('NTJ0000001','SC001',2,120000),('NTJ0000001','SC002',2,300000),('NTJ0000002','SC001',3,120000);

#
# Source for table "dtl_po"
#

CREATE TABLE `dtl_po` (
  `kd_po` char(9) NOT NULL DEFAULT '',
  `kd_sukucadang` char(5) DEFAULT NULL,
  `jml_beli` int(3) DEFAULT NULL,
  `hrg_beli` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "dtl_po"
#

INSERT INTO `dtl_po` VALUES ('PO0000001','SC001',2,100000),('PO0000001','SC002',2,270000),('PO0000002','SC003',1,50000);

#
# Source for table "dtl_servis"
#

CREATE TABLE `dtl_servis` (
  `kd_perbaikan` char(12) NOT NULL DEFAULT '',
  `kd_servis` char(5) DEFAULT NULL,
  `hrg_servis` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "dtl_servis"
#

INSERT INTO `dtl_servis` VALUES ('PRBKN0000001','SVC01',25000),('PRBKN0000002','SVC02',75000);

#
# Source for table "dtl_sukucadang"
#

CREATE TABLE `dtl_sukucadang` (
  `kd_perbaikan` char(12) NOT NULL DEFAULT '',
  `kd_sukucadang` char(5) DEFAULT NULL,
  `jml_sukucadang` int(2) DEFAULT NULL,
  `hrg_jual` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "dtl_sukucadang"
#

INSERT INTO `dtl_sukucadang` VALUES ('PRBKN0000001','SC003',1,60000);

#
# Source for table "isi"
#

CREATE TABLE `isi` (
  `kd_ttb` char(10) DEFAULT NULL,
  `kd_sukucadang` char(5) DEFAULT NULL,
  `jml_terima` int(3) DEFAULT NULL,
  `hrg_beli` int(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "isi"
#

INSERT INTO `isi` VALUES ('TTB0000001','SC001',2,100000),('TTB0000001','SC002',2,270000),('TTB0000002','SC003',1,50000);

#
# Source for table "kendaraan"
#

CREATE TABLE `kendaraan` (
  `no_polisi` char(10) NOT NULL DEFAULT '',
  `id_pelanggan` char(5) DEFAULT NULL,
  `merek` varchar(20) DEFAULT NULL,
  `tipe` varchar(20) DEFAULT NULL,
  `no_rangka` varchar(20) DEFAULT NULL,
  `warna` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`no_polisi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "kendaraan"
#

INSERT INTO `kendaraan` VALUES ('B 123 AA','P001','Honda','Vario','112002','Hitam'),('B 5678 ZZ','P002','Honda','Supra X','990040','Hitam');

#
# Source for table "mekanik"
#

CREATE TABLE `mekanik` (
  `id_mekanik` char(5) NOT NULL DEFAULT '',
  `nm_mekanik` varchar(50) DEFAULT NULL,
  `jenkel` char(1) DEFAULT NULL,
  `no_telpon` varchar(13) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_mekanik`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "mekanik"
#

INSERT INTO `mekanik` VALUES ('MK001','Mk Deni','L','2121212','aaaa'),('MK002','Mk Ayu','P','7739919299292','Jl.a');

#
# Source for table "nota_jual"
#

CREATE TABLE `nota_jual` (
  `kd_nota` char(10) NOT NULL DEFAULT '',
  `tgl_nota` date DEFAULT NULL,
  `id_pelanggan` char(5) DEFAULT NULL,
  `jml_biaya` int(11) DEFAULT NULL,
  PRIMARY KEY (`kd_nota`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "nota_jual"
#

INSERT INTO `nota_jual` VALUES ('NTJ0000001','2023-01-29','P001',840000),('NTJ0000002','2023-02-01','P001',360000);

#
# Source for table "nota_perbaikan"
#

CREATE TABLE `nota_perbaikan` (
  `kd_nota` char(10) NOT NULL DEFAULT '',
  `tgl_nota` date DEFAULT NULL,
  `kd_perbaikan` char(12) NOT NULL DEFAULT '',
  PRIMARY KEY (`kd_nota`,`kd_perbaikan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "nota_perbaikan"
#

INSERT INTO `nota_perbaikan` VALUES ('NTP0000001','2023-01-29','PRBKN0000001');

#
# Source for table "pegawai"
#

CREATE TABLE `pegawai` (
  `id_pegawai` char(5) NOT NULL DEFAULT '',
  `nm_pegawai` varchar(30) DEFAULT NULL,
  `no_telpon` varchar(13) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `posisi` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_pegawai`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "pegawai"
#

INSERT INTO `pegawai` VALUES ('PGW01','Arnold','08979252381','Jakarta','Pegawai');

#
# Source for table "pelanggan"
#

CREATE TABLE `pelanggan` (
  `id_pelanggan` char(4) NOT NULL DEFAULT '',
  `nm_pelanggan` varchar(50) DEFAULT NULL,
  `jenkel` char(1) DEFAULT NULL,
  `no_telpon` varchar(13) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "pelanggan"
#

INSERT INTO `pelanggan` VALUES ('P001','Arnold','L','088812331','Jl. Abc'),('P002','Donskeey','L','087621992','Jl. Def');

#
# Source for table "perbaikan"
#

CREATE TABLE `perbaikan` (
  `kd_perbaikan` char(12) NOT NULL DEFAULT '',
  `tgl_perbaikan` date DEFAULT NULL,
  `id_mekanik` char(5) DEFAULT NULL,
  `no_polisi` char(10) DEFAULT NULL,
  PRIMARY KEY (`kd_perbaikan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "perbaikan"
#

INSERT INTO `perbaikan` VALUES ('PRBKN0000001','2023-01-29','MK001','B 123 AA'),('PRBKN0000002','2023-01-29','MK002','B 5678 ZZ');

#
# Source for table "po"
#

CREATE TABLE `po` (
  `kd_po` char(9) NOT NULL DEFAULT '',
  `tgl_po` date DEFAULT NULL,
  `id_supplier` char(5) DEFAULT NULL,
  PRIMARY KEY (`kd_po`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "po"
#

INSERT INTO `po` VALUES ('PO0000001','2023-01-29','SP001'),('PO0000002','2023-01-30','SP002');

#
# Source for table "servis"
#

CREATE TABLE `servis` (
  `kd_servis` char(5) NOT NULL DEFAULT '',
  `nm_servis` varchar(50) DEFAULT NULL,
  `harga` int(7) DEFAULT NULL,
  PRIMARY KEY (`kd_servis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "servis"
#

INSERT INTO `servis` VALUES ('SVC01','Servis Kecil',25000),('SVC02','Servis Besar',75000);

#
# Source for table "sukucadang"
#

CREATE TABLE `sukucadang` (
  `kd_sukucadang` char(5) NOT NULL DEFAULT '',
  `nm_sukucadang` varchar(50) DEFAULT NULL,
  `jenis` varchar(20) DEFAULT NULL,
  `hrg_jual` int(7) DEFAULT NULL,
  `hrg_beli` int(7) DEFAULT NULL,
  `stok` int(3) DEFAULT NULL,
  `satuan` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`kd_sukucadang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "sukucadang"
#

INSERT INTO `sukucadang` VALUES ('SC001','Ban FDR','Ban',120000,100000,7,'PCS'),('SC002','Velg Araya','Dll',300000,270000,5,'PCS'),('SC003','Oli Top One','Oli',60000,50000,20,'PCS');

#
# Source for table "supplier"
#

CREATE TABLE `supplier` (
  `id_supplier` char(5) NOT NULL DEFAULT '',
  `nm_supplier` varchar(50) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `no_telpon` varchar(13) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "supplier"
#

INSERT INTO `supplier` VALUES ('SP001','Toko MJ','aaaa','2121212','mjmotor@gmail.com'),('SP002','Toko Habibi','jl. ad','2121212','habibibi@gmail.com');

#
# Source for table "temp_dtl_pembelian"
#

CREATE TABLE `temp_dtl_pembelian` (
  `no_pembelian` char(7) NOT NULL DEFAULT '',
  `kd_barang` char(7) DEFAULT NULL,
  `hrg_beli` int(9) DEFAULT NULL,
  `jml_beli` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "temp_dtl_pembelian"
#


#
# Source for table "temp_dtl_penjualan"
#

CREATE TABLE `temp_dtl_penjualan` (
  `kd_nota` char(7) NOT NULL DEFAULT '',
  `kd_sukucadang` char(5) DEFAULT NULL,
  `hrg_jual` int(6) DEFAULT NULL,
  `jml_jual` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "temp_dtl_penjualan"
#


#
# Source for table "temp_dtl_po"
#

CREATE TABLE `temp_dtl_po` (
  `kd_po` char(9) NOT NULL DEFAULT '',
  `kd_sukucadang` char(5) DEFAULT NULL,
  `jml_beli` int(3) DEFAULT NULL,
  `hrg_beli` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "temp_dtl_po"
#


#
# Source for table "temp_dtl_servis"
#

CREATE TABLE `temp_dtl_servis` (
  `kd_perbaikan` char(12) NOT NULL DEFAULT '',
  `kd_servis` char(5) DEFAULT NULL,
  `hrg_servis` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "temp_dtl_servis"
#


#
# Source for table "temp_dtl_sukucadang"
#

CREATE TABLE `temp_dtl_sukucadang` (
  `kd_perbaikan` char(12) NOT NULL DEFAULT '',
  `kd_sukucadang` char(5) DEFAULT NULL,
  `hrg_jual` int(6) DEFAULT NULL,
  `jml_jual` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "temp_dtl_sukucadang"
#


#
# Source for table "ttb"
#

CREATE TABLE `ttb` (
  `kd_ttb` char(10) NOT NULL DEFAULT '',
  `tgl_ttb` date DEFAULT NULL,
  `kd_po` char(9) DEFAULT NULL,
  `no_reffkwt` char(10) DEFAULT NULL,
  PRIMARY KEY (`kd_ttb`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "ttb"
#

INSERT INTO `ttb` VALUES ('TTB0000001','2023-01-29','PO0000001','Ref 1KWT'),('TTB0000002','2023-01-30','PO0000002','Ref 2KWT');

#
# Source for table "user"
#

CREATE TABLE `user` (
  `id_user` char(5) NOT NULL DEFAULT '',
  `password` varchar(20) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "user"
#

INSERT INTO `user` VALUES ('PGW01','admin','Pegawai');

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
