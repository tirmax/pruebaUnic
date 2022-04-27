--Consultas para crear tablas 
CREATE TABLE unic_department
(
    id serial NOT NULL,
    department_name character varying ,
    department_city character varying ,
    CONSTRAINT "unic_department_pkey" PRIMARY KEY (id)
);

CREATE TABLE unic_employee
(
    id integer NOT NULL,
    firsname character varying ,
    lastname character varying ,
    department_id integer,
    salary numeric,
    educationlevel_id integer,
    CONSTRAINT "unic_employee_pkey" PRIMARY KEY (id)
);

CREATE TABLE unic_educationlevel
(
    id integer NOT NULL,
    description character varying ,
    CONSTRAINT "UNIC_educationlevel_pkey" PRIMARY KEY (id)
);


-- insert datos
 INSERT INTO unic_department (id, department_name, department_city) VALUES (2, 'huila', 'la plata');
 INSERT INTO unic_employee (id, firsname, lastname,department_id,salary,educationlevel_id) VALUES (3, 'andres', 'prez',2,2000,1);
 INSERT INTO unic_educationlevel (id, description) VALUES (1, 'universitario');

--consulta para buscar departamentos con el mayor numero de empleados en ese departamento
 select d.department_name, count(e.department_id) as TotalEmpleados
 from UNIC_department d
 inner join UNIC_employee e
 on d.id = e.department_id
 group by d.department_name 
 having count(e.department_id) >= 2
 order by d.department_name
