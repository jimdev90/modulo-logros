CREATE PROCEDURE PA_GET_REPORT_CRIMINAL_GROUP_DATE_GENERAL(
    IN fecha varchar (20),
    IN unidades varchar (100)
)
BEGIN
SELECT sum(cg.quantity) as total,
       cg.id_type_criminal_group,
       tcg.name         as category
FROM bd_modulo_logros.criminal_groups as cg
         inner join types_criminal_group as tcg on cg.id_type_criminal_group = tcg.id
where FIND_IN_SET(cg.cod_uni1, unidades)
  and cg.created_at between concat(fecha, " 06:00:00") and concat(DATE(DATE_ADD(fecha, INTERVAL 1 DAY)), " 05:59:59")
  and cg.deleted_at is null
group by cg.id_type_criminal_group;
END $$


DELIMITER $$
CREATE PROCEDURE PA_GET_REPORT_CURRENCY_DATE_GENERAL(
    IN fecha varchar (20),
    IN unidades varchar (100)
)
BEGIN
SELECT sum(c.quantity) as total,
       c.id_type_currency,
       tc.name         as category
FROM bd_modulo_logros.currencies as c
         inner join types_currency as tc on c.id_type_currency = tc.id
where FIND_IN_SET(c.cod_uni1, unidades)
  and c.created_at between concat(fecha, " 06:00:00") and concat(DATE(DATE_ADD(fecha, INTERVAL 1 DAY)), " 05:59:59")
  and c.deleted_at is null
group by c.id_type_currency;
END $$

DELIMITER $$
CREATE PROCEDURE PA_GET_REPORT_DRUG_DATE_GENERAL(
    IN fecha varchar (20),
    IN unidades varchar (100)
)
BEGIN
SELECT sum(d.ton) as totalTon,
       sum(d.kilogram) as totalKilogram,
       sum(d.gram) as totalGram,
       d.id_type_drug,
       td.name         as category
FROM bd_modulo_logros.drugs as d
         inner join types_drug as td on d.id_type_drug = td.id
where FIND_IN_SET(d.cod_uni1, unidades)
  and d.created_at between concat(fecha, " 06:00:00") and concat(DATE(DATE_ADD(fecha, INTERVAL 1 DAY)), " 05:59:59")
  and d.deleted_at is null
group by d.id_type_drug;
END $$


DELIMITER $$
CREATE PROCEDURE PA_GET_REPORT_EXPLOSIVE_DATE_GENERAL(
    IN fecha varchar (20),
    IN unidades varchar (100)
)
BEGIN
SELECT sum(e.quantity) as total,
       e.id_type_explosive,
       te.name         as category
FROM bd_modulo_logros.explosives as e
         inner join types_explosive as te on e.id_type_explosive = te.id
where FIND_IN_SET(e.cod_uni1, unidades)
  and e.created_at between concat(fecha, " 06:00:00") and concat(DATE(DATE_ADD(fecha, INTERVAL 1 DAY)), " 05:59:59")
  and e.deleted_at is null
group by e.id_type_explosive;
END $$


DELIMITER $$
CREATE PROCEDURE PA_GET_REPORT_FIREARM_DATE_GENERAL(
    IN fecha varchar (20),
    IN unidades varchar (100)
)
BEGIN
SELECT sum(f.quantity) as total,
       f.id_type_firearm,
       tf.name         as category
FROM bd_modulo_logros.firearms as f
         inner join types_firearm as tf on f.id_type_firearm = tf.id
where FIND_IN_SET(f.cod_uni1, unidades)
  and f.created_at between concat(fecha, " 06:00:00") and concat(DATE(DATE_ADD(fecha, INTERVAL 1 DAY)), " 05:59:59")
  and f.deleted_at is null
group by f.id_type_firearm;
END $$

DELIMITER $$
CREATE PROCEDURE PA_GET_REPORT_FUEL_DATE_GENERAL(
    IN fecha varchar (20),
    IN unidades varchar (100)
)
BEGIN
SELECT sum(f.quantity) as total,
       f.id_type_fuel,
       tf.name         as category
FROM bd_modulo_logros.fuels as f
         inner join types_fuel as tf on f.id_type_fuel = tf.id
where FIND_IN_SET(f.cod_uni1, unidades)
  and f.created_at between concat(fecha, " 06:00:00") and concat(DATE(DATE_ADD(fecha, INTERVAL 1 DAY)), " 05:59:59")
  and f.deleted_at is null
group by f.id_type_fuel;
END $$

DELIMITER $$
CREATE PROCEDURE PA_GET_REPORT_OTHER_DATE_GENERAL(
    IN fecha varchar (20),
    IN unidades varchar (100)
)
BEGIN
SELECT sum(ot.quantity) as total,
       ot.id_type_other,
       tot.name         as category
FROM bd_modulo_logros.others as ot
         inner join types_other as tot on ot.id_type_other = tot.id
where FIND_IN_SET(ot.cod_uni1, unidades)
  and ot.created_at between concat(fecha, " 06:00:00") and concat(DATE(DATE_ADD(fecha, INTERVAL 1 DAY)), " 05:59:59")
  and ot.deleted_at is null
group by ot.id_type_other;
END $$

DELIMITER $$
CREATE PROCEDURE PA_GET_REPORT_PERSON_DATE_GENERAL(
    IN fecha varchar (20),
    IN unidades varchar (100)
)
BEGIN
SELECT sum(p.quantity) as total,
       p.id_type_person,
       tp.name         as category
FROM bd_modulo_logros.persons as p
         inner join types_person as tp on p.id_type_person = tp.id
where FIND_IN_SET(p.cod_uni1, unidades)
  and p.created_at between concat(fecha, " 06:00:00") and concat(DATE(DATE_ADD(fecha, INTERVAL 1 DAY)), " 05:59:59")
  and p.deleted_at is null
group by p.id_type_person;
END $$
