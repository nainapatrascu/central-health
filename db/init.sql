CREATE DATABASE pacienti;
use pacienti;

CREATE TABLE pacient(
    cnp bigint(10),
    nume varchar(20),
    prenume varchar(20),
    sex varchar(5),
    ocupatie varchar(30),
    data date,
    asigurat varchar(5),
    id_fisa_internare int(5),
    CONSTRAINT pk_cnp PRIMARY KEY (cnp)
);

CREATE TABLE persoanaContact(
    cnp_pacient bigint(10),
    nume varchar(20),
    prenume varchar(20),
    relatie varchar(10),
    nr_telefon varchar(10),
    adresa_email varchar(30)
);

CREATE TABLE fisa_internare(
    id_fisa_internare int(5),
    motive_internare varchar(100),
    istoric_boala_actuala varchar(100),
    istoric_boli_anterioare varchar(100),
    istoric_boli_familie varchar(100),
    fumator varchar(5),
    consumator_alcool varchar(5),
    id_fisa_investigatii int(5),
    id_sectie int(3),
    CONSTRAINT pk_fisa_int PRIMARY KEY (id_fisa_internare)
);

CREATE TABLE fisaInvestigatii(
    id_fisa_investigatii int(5),
    cerute varchar(100),
    efectuate varchar(100),
    interventii varchar(20),
    id_medicatie int(5),
    CONSTRAINT pk_fisa_inv PRIMARY KEY (id_fisa_investigatii)
);

CREATE TABLE sectie(
    id_sectie int(3),
    nume_sectie varchar(15),
    nr_paturi_total int(2),
    nr_paturi_ocupate int(2),
    CONSTRAINT pk_sectie PRIMARY KEY (id_sectie)
);

CREATE TABLE medicatie(
    id_medicatie int(5),
    nume_medicatie varchar(20),
    cantitate varchar(5),
    perioada int(3),
    CONSTRAINT pk_med PRIMARY KEY (id_medicatie)
);


DELIMITER //


CREATE PROCEDURE adauga_pacient(
    cnp bigint(10),
    nume char(20),
    prenume char(20),
    sex char(5),
    ocupatie char(30),
    data date,
    asigurat char(5),
    id_fisa_internare int(5))
BEGIN
INSERT into pacient(cnp, nume, prenume, sex, ocupatie, data, asigurat, id_fisa_internare) values (cnp, nume, prenume, sex, ocupatie, data, asigurat, id_fisa_internare);
END//


CREATE PROCEDURE adauga_fisa_internare(
    id_fisa_internare int(5),
    motive_internare varchar(100),
    istoric_boala_actuala varchar(100),
    istoric_boli_anterioare varchar(100),
    istoric_boli_familie varchar(100),
    fumator varchar(5),
    consumator_alcool varchar(5),
    id_fisa_investigatii int(5),
    id_sectie int(3))
BEGIN
INSERT into fisa_internare(id_fisa_internare, motive_internare, istoric_boala_actuala, istoric_boli_anterioare, istoric_boli_familie, fumator, consumator_alcool, id_fisa_investigatii, id_sectie) values(id_fisa_internare, motive_internare, istoric_boala_actuala, istoric_boli_anterioare, istoric_boli_familie, fumator, consumator_alcool, id_fisa_investigatii, id_sectie);
END//


CREATE PROCEDURE adauga_persoana_contact(
    cnp_pacient bigint(10),
    nume char(20),
    prenume char(20),
    relatie char(10),
    nr_telefon char(10),
    adresa_email char(30))
BEGIN
INSERT into persoanaContact(cnp_pacient, nume, prenume, relatie, nr_telefon, adresa_email) values(cnp_pacient, nume, prenume, relatie, nr_telefon, adresa_email);
END//

create procedure ext2(cnpp bigint(10))
BEGIN
    set @fisa_int=0;
    select id_fisa_internare into @fisa_int from pacient where cnp=@cnpp;
    set @sectie=0;
    select id_sectie into @sectie from fisa_internare where id_fisa_internare=@fisa_int;
    set @nr_old=0; select nr_paturi_ocupate into @nr_old from sectie where id_sectie=@sectie;
    delete from pacient where cnp=@cnpp;
    delete from persoanaContact where cnp_pacient=@cnpp;
    delete from fisa_internare where id_fisa_internare=@fisa_int;
    set @new_nr=@nr_old-1;
    update sectie set nr_paturi_ocupate=@new_nr where id_sectie=@sectie;
end//

CREATE TRIGGER on_adding_pacient
after insert on fisa_internare
for each row begin
    set @sectie=new.id_sectie;
    set @nr=0;
    select nr_paturi_ocupate into @nr from sectie where id_sectie=@sectie;
    set @new_nr=@nr+1;
    update sectie set nr_paturi_ocupate=@new_nr where id_sectie=@sectie;
END//


CREATE FUNCTION  get_nr_pacienti()
    returns int(5) deterministic
BEGIN
    set @sum=0;
    select sum(nr_paturi_ocupate) into @sum from sectie;
    return @sum;
END//

CREATE FUNCTION  get_nr_total_locuri()
    returns int(5) deterministic
BEGIN
    set @sum=0;
    select sum(nr_paturi_total) into @sum from sectie;
    return @sum;
END//


CREATE FUNCTION get_nr_locuri_libere()
    returns int(5) deterministic
BEGIN
    set @pacienti=0;
    select get_nr_pacienti() into @pacienti;
    set @total=0;
    select get_nr_total_locuri() into @total;
    set @res=@total-@pacienti;
    return @res;
END//

DELIMITER ;

INSERT into pacient(cnp, nume, prenume, sex, ocupatie, data, asigurat, id_fisa_internare) values(1111122222,"Pop","Ioana","f","student",'2020-01-12',"da",11111);
INSERT into pacient(cnp, nume, prenume, sex, ocupatie, data, asigurat, id_fisa_internare) values(2222233333,"Stan","Andrei","m","inginer",'2020-01-10',"da",22222);
INSERT into pacient(cnp, nume, prenume, sex, ocupatie, data, asigurat, id_fisa_internare) values(3333344444,"Popa","Lavinia","f","actrita",'2020-01-08',"da",33333);
INSERT into pacient(cnp, nume, prenume, sex, ocupatie, data, asigurat, id_fisa_internare) values(4444455555,"Cretu","Marian","m","pilot",'2020-01-14',"da",44444);
INSERT into pacient(cnp, nume, prenume, sex, ocupatie, data, asigurat, id_fisa_internare) values(5555566666,"Manescu","Elena","f","secretara",'2020-01-13',"da",55555);


INSERT into fisa_internare(id_fisa_internare,motive_internare,istoric_boala_actuala,istoric_boli_anterioare,istoric_boli_familie,fumator,consumator_alcool,id_fisa_investigatii,id_sectie)
    values(11111,"dureri inima","nu","nu","nu","da","nu",11,1);
INSERT into fisa_internare(id_fisa_internare,motive_internare,istoric_boala_actuala,istoric_boli_anterioare,istoric_boli_familie,fumator,consumator_alcool,id_fisa_investigatii,id_sectie)
    values(22222,"picior rupt","nu","nu","nu","nu","nu",22,3);
INSERT into fisa_internare(id_fisa_internare,motive_internare,istoric_boala_actuala,istoric_boli_anterioare,istoric_boli_familie,fumator,consumator_alcool,id_fisa_investigatii,id_sectie)
    values(33333,"operatie","sunt","nu","nu","da","da",33,2);
INSERT into fisa_internare(id_fisa_internare,motive_internare,istoric_boala_actuala,istoric_boli_anterioare,istoric_boli_familie,fumator,consumator_alcool,id_fisa_investigatii,id_sectie)
    values(44444,"depresie","da","da","da","nu","nu",44,4);
INSERT into fisa_internare(id_fisa_internare,motive_internare,istoric_boala_actuala,istoric_boli_anterioare,istoric_boli_familie,fumator,consumator_alcool,id_fisa_investigatii,id_sectie)
    values(55555,"-","nu","nu","nu","da","da",55,6);


INSERT into persoanaContact(cnp_pacient,nume,prenume,relatie,nr_telefon,adresa_email) values(1111122222,"Pop","Maria","mama","0765478190","popm@yahoo.com");
INSERT into persoanaContact(cnp_pacient,nume,prenume,relatie,nr_telefon,adresa_email) values(2222233333,"Stan","Stefan","frate","0784529111","sstan@gmail.com");
INSERT into persoanaContact(cnp_pacient,nume,prenume,relatie,nr_telefon,adresa_email) values(3333344444,"Popa","Eleonora","mama","0765556789","elypopa@yahoo.com");
INSERT into persoanaContact(cnp_pacient,nume,prenume,relatie,nr_telefon,adresa_email) values(4444455555,"Cretu","Ion","tatal","0743122321","cretu_ion@gmail.com");
INSERT into persoanaContact(cnp_pacient,nume,prenume,relatie,nr_telefon,adresa_email) values(5555566666,"Manescu","Andreea","sora","0773212455","andreeamanescu13@yahoo.com");


INSERT into sectie(id_sectie, nume_sectie, nr_paturi_total, nr_paturi_ocupate) values(1, "Cardiologie", 17, 1);
INSERT into sectie(id_sectie, nume_sectie, nr_paturi_total, nr_paturi_ocupate) values(2, "Chirurgie", 17, 1);
INSERT into sectie(id_sectie, nume_sectie, nr_paturi_total, nr_paturi_ocupate) values(3, "Ortopedie", 19, 1);
INSERT into sectie(id_sectie, nume_sectie, nr_paturi_total, nr_paturi_ocupate) values(4, "Neurologie", 10, 1);
INSERT into sectie(id_sectie, nume_sectie, nr_paturi_total, nr_paturi_ocupate) values(5, "Pediatrie", 20, 0);
INSERT into sectie(id_sectie, nume_sectie, nr_paturi_total, nr_paturi_ocupate) values(6, "Psihiatrie", 14, 1);


