CREATE TABLE mahasiswa (
	id_mahasiswa VARCHAR2(255),
	nama VARCHAR2(255),
	kelas VARCHAR2(255),
	nrp VARCHAR2(20)
);

CREATE TABLE matakuliah (
	id_matakuliah VARCHAR2(255),
	id_mahasiswa VARCHAR2(255),
	nama VARCHAR2(255)
);

CREATE TABLE nilai (
	id_nilai VARCHAR2(255),
	id_matakuliah VARCHAR2(255),
	tugas VARCHAR2(255),
	nilai NUMBER
);