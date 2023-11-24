-- where created_at between curdate() + interval 5 hour and curdate() + interval 1 day + interval 5 hour
-- Esto debería llevar los eventos desde las 5 a. m. de la fecha actual hasta los eventos para el día siguiente a las 5 a. m.
-- Esta consulta obtendrá todos los eventos desde las 6 a.m. de ayer hasta las 5:59 de hoy.
-- where created_at between date_sub(concat(curdate()," 05:00:00"), INTERVAL 1 DAY) and concat(curdate()," 04:59:59")

-- CONSULTA POR DIA '2023-11-23' POR UNIDAD TABLA criminal_groups
DELIMITER $$
CREATE PROCEDURE PA_GET_REPORT_CRIMINAL_GROUP_DATE_UNIDAD(
    IN fecha varchar (20),
    IN unidad varchar (20)
)
BEGIN
SELECT sum(cg.quantity) as total,
       cg.id_type_criminal_group,
       cg.cod_uni1,
       tcg.name         as category
FROM bd_modulo_logros.criminal_groups as cg
         inner join types_criminal_group as tcg on cg.id_type_criminal_group = tcg.id
where cg.cod_uni1 = unidad
  and cg.created_at between concat(fecha, " 05:00:00") and concat(DATE(DATE_ADD(fecha, INTERVAL 1 DAY)), " 04:59:59")
  and cg.deleted_at is null
group by cg.id_type_criminal_group, cg.cod_uni1;
END $$

CALL PA_GET_REPORT_CRIMINAL_GROUP_DATE_UNIDAD('2023-11-23', 47);

-- CONSULTA POR DIA '2023-11-23' POR UNIDAD TABLA currencies
DELIMITER $$
CREATE PROCEDURE PA_GET_REPORT_CURRENCY_DATE_UNIDAD(
    IN fecha varchar (20),
    IN unidad varchar (20)
)
BEGIN
SELECT sum(c.quantity) as total,
       c.id_type_currency,
       c.cod_uni1,
       tc.name         as category
FROM bd_modulo_logros.currencies as c
         inner join types_currency as tc on c.id_type_currency = tc.id
where c.cod_uni1 = unidad
  and c.created_at between concat(fecha, " 05:00:00") and concat(DATE(DATE_ADD(fecha, INTERVAL 1 DAY)), " 04:59:59")
  and c.deleted_at is null
group by c.id_type_currency, c.cod_uni1;
END $$

CALL PA_GET_REPORT_CURRENCY_DATE_UNIDAD('2023-11-23', 47);

-- CONSULTA POR DIA '2023-11-23' POR UNIDAD TABLA drugs
DELIMITER $$
CREATE PROCEDURE PA_GET_REPORT_DRUG_DATE_UNIDAD(
    IN fecha varchar (20),
    IN unidad varchar (20)
)
BEGIN
SELECT sum(d.ton) as totalTon,
       sum(d.kilogram) as totalKilogram,
       sum(d.gram) as totalGram,
       d.id_type_drug,
       d.cod_uni1,
       td.name         as category
FROM bd_modulo_logros.drugs as d
         inner join types_drug as td on d.id_type_drug = td.id
where d.cod_uni1 = unidad
  and d.created_at between concat(fecha, " 05:00:00") and concat(DATE(DATE_ADD(fecha, INTERVAL 1 DAY)), " 04:59:59")
  and d.deleted_at is null
group by d.id_type_drug, d.cod_uni1;
END $$

CALL PA_GET_REPORT_DRUG_DATE_UNIDAD('2023-11-23', 47);

-- CONSULTA POR DIA '2023-11-23' POR UNIDAD TABLA explosives
DELIMITER $$
CREATE PROCEDURE PA_GET_REPORT_EXPLOSIVE_DATE_UNIDAD(
    IN fecha varchar (20),
    IN unidad varchar (20)
)
BEGIN
SELECT sum(e.quantity) as total,
       e.id_type_explosive,
       e.cod_uni1,
       te.name         as category
FROM bd_modulo_logros.explosives as e
         inner join types_explosive as te on e.id_type_explosive = te.id
where e.cod_uni1 = unidad
  and e.created_at between concat(fecha, " 05:00:00") and concat(DATE(DATE_ADD(fecha, INTERVAL 1 DAY)), " 04:59:59")
  and e.deleted_at is null
group by e.id_type_explosive, e.cod_uni1;
END $$

CALL PA_GET_REPORT_EXPLOSIVE_DATE_UNIDAD('2023-11-23', 47);

 -- CONSULTA POR DIA '2023-11-23' POR UNIDAD TABLA firearms
DELIMITER $$
CREATE PROCEDURE PA_GET_REPORT_FIREARM_DATE_UNIDAD(
    IN fecha varchar (20),
    IN unidad varchar (20)
)
BEGIN
SELECT sum(f.quantity) as total,
       f.id_type_firearm,
       f.cod_uni1,
       tf.name         as category
FROM bd_modulo_logros.firearms as f
         inner join types_firearm as tf on f.id_type_firearm = tf.id
where f.cod_uni1 = unidad
  and f.created_at between concat(fecha, " 05:00:00") and concat(DATE(DATE_ADD(fecha, INTERVAL 1 DAY)), " 04:59:59")
  and f.deleted_at is null
group by f.id_type_firearm, f.cod_uni1;
END $$

CALL PA_GET_REPORT_FIREARM_DATE_UNIDAD('2023-11-23', 47);

-- CONSULTA POR DIA '2023-11-23' POR UNIDAD TABLA fuels
DELIMITER $$
CREATE PROCEDURE PA_GET_REPORT_FUEL_DATE_UNIDAD(
    IN fecha varchar (20),
    IN unidad varchar (20)
)
BEGIN
SELECT sum(f.quantity) as total,
       f.id_type_fuel,
       f.cod_uni1,
       tf.name         as category
FROM bd_modulo_logros.fuels as f
         inner join types_fuel as tf on f.id_type_fuel = tf.id
where f.cod_uni1 = unidad
  and f.created_at between concat(fecha, " 05:00:00") and concat(DATE(DATE_ADD(fecha, INTERVAL 1 DAY)), " 04:59:59")
  and f.deleted_at is null
group by f.id_type_fuel, f.cod_uni1;
END $$

CALL PA_GET_REPORT_FUEL_DATE_UNIDAD('2023-11-23', 47);

-- CONSULTA POR DIA '2023-11-23' POR UNIDAD TABLA others
DELIMITER $$
CREATE PROCEDURE PA_GET_REPORT_OTHER_DATE_UNIDAD(
    IN fecha varchar (20),
    IN unidad varchar (20)
)
BEGIN
SELECT sum(ot.quantity) as total,
       ot.id_type_other,
       ot.cod_uni1,
       tot.name         as category
FROM bd_modulo_logros.others as ot
         inner join types_other as tot on ot.id_type_other = tot.id
where ot.cod_uni1 = unidad
  and ot.created_at between concat(fecha, " 05:00:00") and concat(DATE(DATE_ADD(fecha, INTERVAL 1 DAY)), " 04:59:59")
  and ot.deleted_at is null
group by ot.id_type_other, ot.cod_uni1;
END $$

CALL PA_GET_REPORT_OTHER_DATE_UNIDAD('2023-11-23', 47);

-- CONSULTA POR DIA '2023-11-23' POR UNIDAD TABLA persons
DELIMITER $$
CREATE PROCEDURE PA_GET_REPORT_PERSON_DATE_UNIDAD(
    IN fecha varchar (20),
    IN unidad varchar (20)
)
BEGIN
SELECT sum(p.quantity) as total,
       p.id_type_person,
       p.cod_uni1,
       tp.name         as category
FROM bd_modulo_logros.persons as p
         inner join types_person as tp on p.id_type_person = tp.id
where p.cod_uni1 = unidad
  and p.created_at between concat(fecha, " 05:00:00") and concat(DATE(DATE_ADD(fecha, INTERVAL 1 DAY)), " 04:59:59")
  and p.deleted_at is null
group by p.id_type_person, p.cod_uni1;
END $$

CALL PA_GET_REPORT_PERSON_DATE_UNIDAD('2023-11-23', 47);
