CREATE TABLE fabrication (
    `item` VARCHAR(18),
    `item_id` VARCHAR(6),
    `raw_material` VARCHAR(40),
    `Quantity` VARCHAR(15),
    `in_date` DATETIME,
    `out_date` DATETIME, 
	`Dept_no` INT DEFAULT 100,
    `Approval` INT DEFAULT 0,
    PRIMARY KEY(item_id)
);
INSERT INTO fabrication(item,item_id,raw_material,Quantity,in_date,out_date,Dept_no,Approval) VALUES
	('tub','T101','sheet steel','10 sqft','2020-02-14','2020-02-21',100,1),
	('pump','T102','plastics','10 kg','2020-02-16','2020-02-20',100,1),
	('spin tub','T103','stainless steel','5 kg-m3','2020-02-27','2024-05-03',100,0),
	('wash tub','T104','(enameling iron) Porcelain coating','24 gauge','2022-02-27','2023-03-02',100,0),
	('balance ring','T105','plastics','3 kg ','2021-03-16','2024-03-21',100,0),
	('transmission gears','T107','cast aluminum','ingots—20','2022-03-26','2023-09-04',100,0),
	('plastic brackets','T108','plastics','2 kg','2021-08-04','2024-12-04',100,0),
	('tub','T109','sheet steel','10 sqft','2024-02-14','2024-02-21',100,0),
	('pump','T110','plastics','10 kg','2023-02-16','2024-02-20',100,0),
	('spin tub','T111','steel (enameling iron) Porcelain coating','5 kg-m3','2020-02-27','2020-05-03',100,1),
	('wash tub','T112','(enameling iron) Porcelain coating','24 gauge','2023-02-27','2024-03-02',100,0),
	('balance ring','T113','stainless steel','2 kg-m3 ','2020-03-16','2024-03-21',100,0),
	('transmission gears','T115','cast aluminum','ingots—20','2020-03-26','2020-09-04',100,0),
	('plastic brackets','T116',' plastic',' 2 kg','2020-08-04','2020-12-04',100,0),
	('pump','T117','plastics','10 kg','2020-02-16','2020-02-20',100,0),
	('spin tub','T118','stainless steel','5 kg-m3','2020-02-27','2020-05-03',100,1),
	('wash tub','T119','(enameling iron) Porcelain coating','24 gauge','2020-02-27','2020-03-02',100,1),
	('balance ring','T120','porcelain enamel','8 gauge','2020-03-16','2020-03-21',100,0),
	('transmission gears','T122','cast aluminum','ingots—20','2020-03-26','2020-09-04',100,0),
	('plastic brackets','T123','plastics','3 kg','2020-08-04','2020-12-04',100,0),
	('tub','T124','sheet steel','10 sqft','2020-02-14','2020-12-03',100,0),
	('spin tub','T125','stainless steel','5 kg-m3','2020-02-27','2020-05-03',100,0),
	('wash tub','T126','(enameling iron) Porcelain coating','24 gauge','2020-02-27','2020-03-02',100,0),
	('balance ring','T127','porcelain enamel','8 gauge','2020-03-16','2020-03-21',100,0),
	('transmission gears','T128','cast aluminum','ingots—20','2020-03-26','2020-09-04',100,0),
	('plastic brackets','T129','plastics','3 kg','2020-08-04','2020-12-04',100,0),
	('tub','T130','sheet steel','10 sqft','2020-02-14','2020-12-03',100,0),

    ('Hydraulic Pump','WM125',' Cast Iron','10 kg','2020-08-04','2022-12-04',100,1),
	('Pneumatic Cylinder','WM126','Stainless Steel','20 kg','2021-02-16','2022-02-20',100,1),
	('Valve','WM127','Aluminum','1 piece','2022-02-27','2022-05-03',100,1),
	('Hydraulic Pump','WM128','Cast Iron','10 kg','2020-02-27','2022-03-02',100,1),
	('balance ring','WM129','porcelain enamel','8 gauge','2020-03-26','2020-03-24',100,1),
	('Pneumatic Cylinder','WM130','Stainless Steel','20 kg','2020-03-21','2020-12-04',100,1),
	('Hydraulic Pump','WM131','Cast Iron','10 kg','2020-09-14','2021-12-14',100,1),
	('Valve','WM132','Aluminum','1 piece','2022-02-24','2022-12-30',100,1),
	('Pneumatic Cylinder','WM133','Stainless steel','20 kg','2021-02-27','2022-05-03',100,1),
	('Bearings','WM135','Stainless Steel','10 pieces','2020-02-27','2021-03-02',100,1),
	('Hydraulic Pump','WM136','Cast Iron','10 kg','2022-03-16','2022-03-21',100,1),
	('transmission gears','WM137','cast aluminum','ingots—20','2021-03-26','2021-09-04',100,1),
	('plastic brackets','WM138','plastics','3 kg','2020-09-04','2020-11-04',100,1),
	('Pneumatic Cylinder','WM139','Stainless Steel','20 kg','2020-01-14','2021-11-03',100,1),

    ('Hydraulic Pump','WM140','Cast Iron','10 kg','2020-09-04','2021-12-24',100,1),
	('Pneumatic Cylinder','WM141','Stainless Steel','20 kg','2020-12-16','2021-02-20',100,1),
	('Hydraulic Pump','WM142','Cast Iron','10 kg','2021-02-27','2022-05-03',100,1),
	('Bearings','WM143','Stainless Steel','10 pieces','2022-02-27','2022-03-12',100,1),
	('Valve','WM145','Aluminum','1 piece','2020-03-26','2020-03-21',100,1),
	('transmission gears','WM147','cast aluminum','ingots—20','2020-03-26','2021-09-24',100,1),
	('Pneumatic Cylinder','WM148','Stainless Steel','20 kg','2020-08-04','2022-12-24',100,1),
	('Bearings','WM149','Stainless Steel','10 pieces','2020-12-14','2020-12-23',100,1),
	('Hydraulic Pump','WM150','Cast Iron','10 kg','2021-02-27','2022-05-03',100,1),
	('Pneumatic Cylinder','WM151','Stainless Steel','20 kg','2021-02-27','2022-03-02',100,1),
	('Hydraulic Pump','WM152','Cast Iron','10 kg','2022-03-16','2022-03-21',100,1),
	('transmission gears','WM153','cast aluminum','ingots—20','2021-03-26','2021-09-04',100,1),
	('Valve','WM154','Aluminum','1 piece','2022-08-04','2022-12-04',100,1),
	('Hydraulic Pump','WM155','Cast Iron','10 kg','2021-02-14','2022-12-03',100,1);


    ('Pneumatic Cylinder','WM156','Stainless Steel','20 kg','2020-08-04','2022-12-04',100,1),
	('Hydraulic Pump','WM157','Cast Iron','10 kg','2020-02-16','2021-02-20',100,1),
	('Valve','WM158','Aluminum','1 piece','2021-02-27','2022-05-03',100,1),
	('Pneumatic Cylinder','WM159','Stainless Steel','20 kg','2021-02-27','2022-03-02',100,1),
	('Hydraulic Pump','WM160','Cast Iron','10 kg','2021-03-16','2022-03-21',100,1),
	('transmission gears','WM161','cast aluminum','ingots—20','2022-03-26','2022-09-04',100,1),
	('plastic brackets','WM162','plastics','3 kg','2022-08-04','2022-12-04',100,1),
	('Hydraulic Pump','WM163','Cast Iron','10 kg','2022-02-14','2022-12-03',100,1),
	('Pneumatic Cylinder','WM164','Stainless steel','20 kg','2020-02-17','2020-05-23',100,1);
    ('Pneumatic Cylinder','WM165','Stainless Steel','20 kg','2021-02-27','2022-03-02',100,1),
	('Hydraulic Pump','WM166','Cast Iron','10 kg','2021-03-16','2022-03-21',100,1),
	('transmission gears','WM167','cast aluminum','ingots—20','2022-03-26','2022-09-04',100,1),
	('plastic brackets','WM168','plastics','3 kg','2022-08-04','2022-12-04',100,1),
	('Hydraulic Pump','WM169','Cast Iron','10 kg','2022-02-14','2022-12-03',100,1),
	('Pneumatic Cylinder','WM170','Stainless steel','20 kg','2020-02-17','2020-05-23',100,1);

    
CREATE TABLE sub_assembly (
    `Assembly_ID` VARCHAR(8),
    `process` VARCHAR(21),
    `Item_ID` VARCHAR(6),
    `Machine_ID` VARCHAR(8),
    `start_date` DATETIME,
    `end_date` DATETIME,
    `Dept_no` INT default 101,
    `Approval` INT DEFAULT 0,
    PRIMARY KEY(Assembly_ID),
	FOREIGN KEY(Item_ID) REFERENCES fabrication(item_id) ON CASCADE DELETE
);
INSERT INTO sub_assembly(Assembly_ID,process,Item_ID,Machine_ID,start_date,end_date) VALUES 
	('SAWM3031','Transmission Assembly','T101','FA_WM124','2020-05-02','2020-08-11'),
	('SAWM3032','Electrical Assembly','T102','FA_WM124','2020-05-19','2020-07-03'),
	('SAWM3033','Transmission Assembly','WM125','FA_WM125','2020-04-11','2020-07-21'),
	('SAWM3034','Electrical Assembly','WM126','FA_WM126','2020-05-01','2020-07-03'),
	('SAWM3035','Tub assemblies','WM127','FA_WM127','2020-03-21','2020-08-10'),
	('SAWM3036','Mechanical assembly','WM128','FA_WM128','2020-03-15','2020-06-26'),
	('SAWM3037','Weld Assembly. ','WM129','FA_WM129','2020-04-15','2020-08-08'),
	('SAWM3038','Spot Weld Assembly','WM130','FA_WM130','2020-05-23','2020-08-04'),
	('SAWM3039','Transmission Assembly','WM131','FA_WM131','2020-05-25','2020-06-26'),
	('SAWM3040','Tub assemblies','WM132','FA_WM132','2020-06-06','2020-06-27'),
	('SAWM3041','Weld Assembly.','WM133','FA_WM133','2020-05-23','2020-08-15'),
	('SAWM3042','Electrical Assembly','T111','FA_WM134','2020-04-28','2020-08-07'),
	('SAWM3043','Mechanical assembly','WM135','FA_WM135','2020-03-10','2020-07-05'),
	('SAWM3044','Spot Weld Assembly','WM136','FA_WM136','2020-05-09','2020-08-16'),
	('SAWM3045','Transmission Assembly','WM137','FA_WM137','2020-06-06','2020-06-27'),
	('SAWM3046','Tub assemblies','WM138','FA_WM138','2020-05-01','2020-08-08'),
	('SAWM3047','Weld Assembly.','WM139','FA_WM139','2020-05-13','2020-07-05'),
	('SAWM3048','Electrical Assembly','WM140','FA_WM140','2020-05-28','2020-08-09'),
	('SAWM3049','Mechanical assembly','WM141','FA_WM141','2020-05-20','2020-08-01'),
	('SAWM3050','Spot Weld Assembly','WM142','FA_WM142','2020-05-06','2020-06-24'),
	('SAWM3051','Transmission Assembly','WM143','FA_WM143','2020-04-27','2020-08-10'),
	('SAWM3052','Tub assemblies','T118','FA_WM144','2020-06-10','2020-08-03'),
	('SAWM3053','Weld Assembly.','WM145','FA_WM145','2020-04-23','2020-07-02'),
	('SAWM3054','Electrical Assembly','T119','FA_WM146','2020-06-04','2020-08-16'),
	('SAWM3055','Mechanical assembly','WM147','FA_WM147','2020-05-18','2020-07-05'),
	('SAWM3056','Spot Weld Assembly','WM148','FA_WM148','2020-05-28','2020-08-05'),
	('SAWM3057','Transmission Assembly','WM149','FA_WM149','2020-05-19','2020-07-20'),
	('SAWM3058','Tub assemblies','WM150','FA_WM150','2020-04-19','2020-07-12'),
	('SAWM3059','Weld Assembly.','WM151','FA_WM151','2020-02-15','2020-06-29'),
	('SAWM3060','Electrical Assembly','WM152','FA_WM152','2020-04-17','2020-08-03'),
	('SAWM3061','Mechanical assembly','WM153','FA_WM153','2020-04-16','2020-08-06'),
	('SAWM3062','Spot Weld Assembly','WM154','FA_WM154','2020-04-20','2020-08-10'),
	('SAWM3063','Weld Assembly.','WM155','FA_WM155','2020-04-11','2020-07-09'),
	('SAWM3064','Electrical Assembly','WM156','FA_WM156','2020-06-14','2020-07-11'),
	('SAWM3065','Mechanical assembly','WM157','FA_WM157','2020-05-05','2020-08-14'),
	('SAWM3066','Spot Weld Assembly','WM158','FA_WM158','2020-04-23','2020-07-08'),
	('SAWM3067','Transmission Assembly','WM159','FA_WM159','2020-05-21','2020-08-01'),
	('SAWM3068','Tub assemblies','WM160','FA_WM160','2020-05-30','2020-07-23'),
	('SAWM3069','Weld Assembly.','WM161','FA_WM161','2020-11-02','2020-07-13'),
	('SAWM3070','Electrical Assembly','WM162','FA_WM162','2020-06-01','2020-07-22'),
	('SAWM3071','Mechanical assembly','WM163','FA_WM163','2020-05-05','2020-07-05'),
	('SAWM3072','Spot Weld Assembly','WM164','FA_WM164','2020-06-02','2020-07-19'),
	('SAWM3073','Transmission Assembly','WM165','FA_WM165','2020-05-21','2020-08-01'),
	('SAWM3074','Tub assemblies','WM166','FA_WM166','2020-05-30','2020-07-23'),
	('SAWM3075','Weld Assembly.','WM167','FA_WM167','2020-11-02','2020-07-13'),
	('SAWM3076','Electrical Assembly','WM168','FA_WM168','2020-06-01','2020-07-22'),
	('SAWM3078','Mechanical assembly','WM169','FA_WM169','2020-05-05','2020-07-05'),
	('SAWM3079','Spot Weld Assembly','WM170','FA_WM170','2020-06-02','2020-07-19');

CREATE TABLE assembly (
    `process` VARCHAR(23),
    `Process_ID` VARCHAR(17),
    `Machine_ID` VARCHAR(19),
    `Start_Date` DATETIME,
    `END_Date` DATETIME,
    `Dept_no` INT default 102,
    `Approval` INT DEFAULT 0,
    PRIMARY KEY(Machine_ID)
);
INSERT INTO assembly(process,Process_ID,Machine_ID,Start_Date,END_Date) VALUES 
	('Component Integration','SAWM3036_FA_WM128','MAII1017ECME3020079','2020-09-25','2020-12-06'),
	('Electrical Testing','SAWM3042_FA_WM164','MAII1017ECME3020080','2020-09-26','2021-01-10'),
	('Complaince','SAWM3069_FA_WM135','MAII1017ECME3020081','2020-10-05','2021-01-09'),
	('Certification Standards','SAWM3067_FA_WM136','MAII1017ECME3020082','2020-08-03','2021-01-25'),
	('pivot dome','SAWM3042_FA_WM137','MAII1017ECME3020083','2020-09-11','2021-01-29'),
	('brake assembly','SAWM3042_FA_WM138','MAII1017ECME3020084','2020-09-30','2021-01-23'),
	('module','SAWM3069_FA_WM139','MAII1017ECME3020085','2020-07-15','2020-12-19'),
	('Powder Coating Process','SAWM3042_FA_WM140','MAII1017ECME3020086','2020-10-03','2020-12-31'),
	('Testing and Inspection','SAWM3058_FA_WM141','MAII1017ECME3020087','2020-10-23','2020-12-31'),
	('Component Integration','SAWM3042_FA_WM142','MAII1017ECME3020088','2020-09-16','2021-01-11'),
	('Electrical Testing','SAWM3047_FA_WM143','MAII1017ECME3020089','2020-10-14','2021-01-25'),
	('Complaince','SAWM3042_FA_WM144','MAII1017ECME3020090','2020-10-30','2021-01-16'),
	('Certification Standards','SAWM3042_FA_WM145','MAII1017ECME3020091','2020-09-15','2020-12-19'),
	('pivot dome','SAWM3067_FA_WM146','MAII1017ECME3020092','2020-09-30','2020-12-03'),
	('brake assembly','SAWM3042_FA_WM147','MAII1017ECME3020093','2020-07-18','2021-01-31'),
	('module','SAWM3042_FA_WM148','MAII1017ECME3020094','2020-10-03','2020-12-11'),
	('Powder Coating Process','SAWM3042_FA_WM149','MAII1017ECME3020095','2020-11-28','2020-12-21'),
	('Testing and Inspection','SAWM3058_FA_WM150','MAII1017ECME3020096','2020-09-07','2021-01-21'),
	('Component Integration','SAWM3042_FA_WM151','MAII1017ECME3020097','2020-10-22','2021-01-08'),
	('Electrical Testing','SAWM3069_FA_WM152','MAII1017ECME3020098','2020-09-14','2020-12-21'),
	('Complaince','SAWM3042_FA_WM153','MAII1017ECME3020099','2020-09-24','2020-12-06'),
	('Certification Standards','SAWM3042_FA_WM154','MAII1017ECME3020100','2020-10-27','2020-12-20'),
	('pivot dome','SAWM3067_FA_WM155','MAII1017ECME3020101','2020-10-29','2021-01-12'),
	('brake assembly','SAWM3047_FA_WM156','MAII1017ECME3020102','2020-09-12','2021-01-07'),
	('module','SAWM3042_FA_WM157','MAII1017ECME3020103','2020-11-04','2021-01-25'),
	('Powder Coating Process','SAWM3042_FA_WM158','MAII1017ECME3020104','2020-10-26','2021-01-25'),
	('Testing and Inspection','SAWM3042_FA_WM159','MAII1017ECME3020105','2020-11-17','2021-01-03'),
	('Component Integration','SAWM3042_FA_WM160','MAII1017ECME3020106','2020-10-24','2021-01-03'),
	('Electrical Testing','SAWM3042_FA_WM161','MAII1017ECME3020107','2020-10-09','2020-12-26'),
	('Complaince','SAWM3042_FA_WM162','MAII1017ECME3020108','2020-07-24','2021-01-21'),
	('Certification Standards','SAWM3047_FA_WM163','MAII1017ECME3020109','2020-08-28','2020-12-30'),
	('pivot dome','SAWM3042_FA_WM164','MAII1017ECME3020110','2020-11-17','2021-01-26'),
	('brake assembly','SAWM3042_FA_WM165','MAII1017ECME3020111','2020-10-28','2021-01-10'),
	('module','SAWM3042_FA_WM166','MAII1017ECME3020112','2020-06-29','2020-12-22'),
	('Powder Coating Process','SAWM3072_FA_WM167','MAII1017ECME3020113','2020-09-14','2021-01-23'),
	('Testing and Inspection','SAWM3072_FA_WM168','MAII1017ECME3020114','2020-11-12','2020-12-08');

CREATE TABLE Department (
    ID INT PRIMARY KEY,
    Username VARCHAR(50) NOT NULL,
    Password VARCHAR(50) NOT NULL
);
INSERT INTO Department VALUES
(100,'Fabricator','Fabricator'),
(101,'Sub_Assembly','Sub_Assembly'),
(102,'Assembly','Assembly'),
(104,'Admin','Admin');

CREATE TABLE supply_chain_data (
	`Machine_ID` VARCHAR(19),
	`Process_ID` VARCHAR(17),
	`process_Name` VARCHAR(21),
    `Assembly_ID` VARCHAR(8),
	`Item_ID_1` VARCHAR(6),
    `Item_ID_2` VARCHAR(6),
    `start_date` DATETIME,
    `end_date` DATETIME,
    PRIMARY KEY (Assembly_ID, Machine_ID),
    FOREIGN KEY (Assembly_ID) REFERENCES sub_assembly(Assembly_ID),
    FOREIGN KEY (Machine_ID) REFERENCES assembly(Machine_ID)
);

SET GLOBAL event_scheduler = ON;

DELIMITER //

CREATE EVENT `approval_event`
ON SCHEDULE EVERY 20 SECOND
DO
BEGIN
    
    DECLARE process_val VARCHAR(255);
    DECLARE processId_val VARCHAR(255);
    DECLARE machineId_val VARCHAR(255);
    DECLARE end_date_val DATETIME;
    DECLARE parts_val TEXT;
    DECLARE processId1_val VARCHAR(255);
    DECLARE processId2_val VARCHAR(255);
    DECLARE start_date_val DATETIME;
    DECLARE item_id_1_val VARCHAR(255);
    DECLARE Assembly_ID_1_val VARCHAR(255);
    DECLARE item_id_2_val VARCHAR(255);
    DECLARE Assembly_ID_2_val VARCHAR(255);
    
    SELECT process, Process_ID, Machine_ID, END_Date
    INTO process_val, processId_val, machineId_val, end_date_val
    FROM assembly
    WHERE Approval = 0 AND END_Date < NOW()
    LIMIT 1;
    
    IF process_val IS NOT NULL THEN
        SET parts_val = SUBSTRING_INDEX(processId_val, '_', 1);
        SET processId1_val = parts_val;
        SET processId2_val = SUBSTRING_INDEX(processId_val, '_', -1);
    
        SELECT Item_ID, Assembly_ID, start_date
        INTO item_id_1_val, Assembly_ID_1_val, start_date_val
        FROM sub_assembly
        WHERE Assembly_ID = processId1_val
        LIMIT 1;
    
        SELECT Item_ID, Assembly_ID
        INTO item_id_2_val, Assembly_ID_2_val
        FROM sub_assembly
        WHERE Machine_ID = processId2_val
        LIMIT 1;
    
        UPDATE assembly
        SET Approval = 1
        WHERE Machine_ID = machineId_val;
    
        UPDATE sub_assembly
        SET Approval = 1
        WHERE Assembly_ID = Assembly_ID_1_val;
    
        UPDATE sub_assembly
        SET Approval = 1
        WHERE Assembly_ID = Assembly_ID_2_val;
    
        INSERT INTO supply_chain_data (Machine_ID, Process_ID, process_Name, Assembly_ID, Item_ID_1, Item_ID_2, start_date, end_date)
        VALUES (machineId_val, processId_val, process_val, Assembly_ID_1_val, item_id_1_val, item_id_2_val, start_date_val, end_date_val);
    END IF;
END //

DELIMITER ;


DELIMITER //

CREATE EVENT `assembly_process_cleanup_event`
ON SCHEDULE EVERY 5 SECOND
DO
BEGIN
    DELETE FROM assembly
    WHERE REGEXP_LIKE(process, '^[^a-zA-Z]')
    OR LENGTH(process) < 3;

END //

DELIMITER ;



DELIMITER //

CREATE EVENT `subassembly_process_cleanup_event`
ON SCHEDULE EVERY 5 SECOND
DO
BEGIN
    DECLARE itemID VARCHAR(50);
    
    DECLARE cur CURSOR FOR SELECT Item_ID FROM sub_assembly WHERE REGEXP_LIKE(process, '^[^a-zA-Z]') OR LENGTH(process) < 3;
    OPEN cur;

    read_loop: LOOP
        FETCH cur INTO itemID;
        IF itemID IS NULL THEN
            LEAVE read_loop;
        END IF;

        UPDATE fabrication SET Approval = 0 WHERE item_id = itemID;
        
        DELETE FROM sub_assembly WHERE Item_ID = itemID;
    END LOOP;

    CLOSE cur;
END //

DELIMITER ;
