

-- ============ E/R to relations
-- items (UPC, whs_count, name, case_quanity)
-- sells (UPC, store, price, on_hand)
-- stores (number, addr)
-- employs (store, employee)
-- employee (userid, name, job, pw)
-- permissions (employee, command)
-- commands (name, attribute, change)
-- location (item, store, dept, section)

-- to drop those tables that have been created earlier
DROP TABLE location;
DROP TABLE employs;
DROP TABLE permissions;
DROP TABLE sells;
DROP TABLE commands;
DROP TABLE stores;
DROP TABLE items;
DROP TABLE employees;

-- ============ CREATE TABLE's 
create table items (
    upc char(13) PRIMARY KEY,
    whs_count int,
    name varchar (64),
    case_quanity int
);
create table stores(
    num int PRIMARY KEY,
    city varchar (64),
    addr varchar (64)
);
create table sells (
    upc char(13),
    store int,
    price decimal(10,2),
    on_hand int,
    FOREIGN KEY (upc) REFERENCES items(upc),
    FOREIGN KEY (store) REFERENCES stores(num)
);
create table employees(
    userid varchar (64) PRIMARY KEY,
    name varchar (64),
    job_title varchar (64),
    pw varchar (64)
);
create table employs(
    store int,
    employee varchar(64),
    FOREIGN KEY (store) REFERENCES stores(num),
    FOREIGN KEY (employee) REFERENCES employees(userid),
    PRIMARY KEY (store, employee)
);
create table commands (
    name varchar (64) PRIMARY KEY,
    element varchar (64),
    canMod BOOLEAN
);
create table permissions (
    employee varchar (64),
    command varchar (64),
    FOREIGN KEY (employee) REFERENCES employees (userid),
    FOREIGN KEY (command) REFERENCES commands(name)
);
create table location (
    item char(13) REFERENCES items(upc),
    store int,
    dept varchar(64),
    section_num char (8),
    FOREIGN KEY (store) REFERENCES stores (num),
    PRIMARY KEY (store, dept, section_num)
);
-- ============ INSERT test data

INSERT INTO commands VALUES ('set price', 'price', TRUE);
INSERT INTO commands VALUES ('check price', 'price', FALSE);
INSERT INTO commands VALUES ('check location', 'location', FALSE);
INSERT INTO commands VALUES ('check on-hand', 'on_hand', FALSE);
INSERT INTO commands VALUES ('set on-hand', 'on_hand', TRUE);

INSERT INTO employees VALUES ('bWalton', 'Bob Walton', 'Store Manager', 'password');
INSERT INTO employees VALUES ('cCool', 'Calvin Coolidge', 'Sales Associate', 'password');
INSERT INTO employees VALUES ('aHart', 'Amelia Earhart', 'Sales Associate', 'password');
INSERT INTO employees VALUES ('mark5', 'Mark Martin', 'Sales Associate', 'password');
INSERT INTO employees VALUES ('OGBush', 'George H. W. Bush', 'Cashier', 'password');
INSERT INTO employees VALUES ('cRice', 'Condoleeza Rice', 'Cashier', 'password');
INSERT INTO employees VALUES ('bClinton', 'Bill Clinton', 'Store Manager', 'password');
INSERT INTO employees VALUES ('FfDurst', 'Fred Durst', 'Cashier', 'password');
INSERT INTO employees VALUES ('beowulf', 'Its Beowulf', 'Store Manager', 'password');

INSERT INTO stores VALUES (0001, 'Jonesboro', '123 Baker St.');
INSERT INTO stores VALUES (0002, 'Jonesboro', '123 Sesame St.');
INSERT INTO stores VALUES (0003, 'Little Rock', '456 Fair Ave.');

INSERT INTO employs VALUES (0001, 'beowulf'); -- ,pay );
INSERT INTO employs VALUES (0001, 'cCool');
INSERT INTO employs VALUES (0001, 'OGBush');
INSERT INTO employs VALUES (0002, 'bClinton');
INSERT INTO employs VALUES (0002, 'aHart');
INSERT INTO employs VALUES (0002, 'cRice');
INSERT INTO employs VALUES (0003, 'FfDurst');
INSERT INTO employs VALUES (0003, 'bWalton');
INSERT INTO employs VALUES (0003, 'mark5');

INSERT INTO permissions VALUES ('bWalton', 'set price');
INSERT INTO permissions VALUES ('bClinton', 'set price');
INSERT INTO permissions VALUES ('beowulf', 'set price');
INSERT INTO permissions VALUES ('bWalton', 'check price');
INSERT INTO permissions VALUES ('beowulf', 'check price');
INSERT INTO permissions VALUES ('cCool', 'check price');
INSERT INTO permissions VALUES ('aHart', 'check price');
INSERT INTO permissions VALUES ('mark5', 'check price');
INSERT INTO permissions VALUES ('OGBush', 'check price');
INSERT INTO permissions VALUES ('cRice', 'check price');
INSERT INTO permissions VALUES ('bClinton', 'check price');
INSERT INTO permissions VALUES ('bClinton', 'set on-hand');
INSERT INTO permissions VALUES ('beowulf', 'set on-hand');
INSERT INTO permissions VALUES ('mark5', 'set on-hand');
INSERT INTO permissions VALUES ('aHart', 'set on-hand');
INSERT INTO permissions VALUES ('cCool', 'set on-hand');
INSERT INTO permissions VALUES ('bWalton', 'set on-hand');

INSERT INTO items VALUES ('0072080149070', 40, 'Chips', 8);
INSERT INTO items VALUES ('0490000561430', 24, 'Sportsade', 12);
INSERT INTO items VALUES ('0932040189020', 4, 'Red Shirt', 4);
INSERT INTO items VALUES ('0832040179810', 4, 'Blue Shirt', 4);
INSERT INTO items VALUES ('0132456489030', 0, 'Brown Pants', 3);
INSERT INTO items VALUES ('0032040189020', 36, 'Lighters', 12);
INSERT INTO items VALUES ('0467264854126', 18, 'Sunny Delight', 9);
INSERT INTO items VALUES ('0547896321092', 2, 'Electric Fan', 1);
INSERT INTO items VALUES ('1147895645645', 1, 'Boat', 1);
INSERT INTO items VALUES ('0302040189887', 1, 'Coffee Maker', 1);

INSERT INTO sells VALUES ('0132456489030', 0001, 13.00, 2);
INSERT INTO sells VALUES ('0072080149070', 0001, 1.25, 3);
INSERT INTO sells VALUES ('0072080149070', 0002, 0.99, 7);
INSERT INTO sells VALUES ('0072080149070', 0003, 1.99, 8);
INSERT INTO sells VALUES ('0490000561430', 0001, 1.55, 9);
INSERT INTO sells VALUES ('0490000561430', 0003, 1.85, 7);
INSERT INTO sells VALUES ('0032040189020', 0001, 0.89, 13);
INSERT INTO sells VALUES ('0032040189020', 0002, 0.77, 15);
INSERT INTO sells VALUES ('0932040189020', 0001, 9.98, 4);
INSERT INTO sells VALUES ('0932040189020', 0002, 9.98, 0);
INSERT INTO sells VALUES ('0467264854126', 0002, 9.98, 5);
INSERT INTO sells VALUES ('0832040179810', 0003, 18.87, 4);
INSERT INTO sells VALUES ('0302040189887', 0003, 24.48, 0);
INSERT INTO sells VALUES ('0547896321092', 0003, 12.86, 2);

INSERT INTO location VALUES ('0072080149070', 0001, 'A', '002-001');
INSERT INTO location VALUES ('0072080149070', 0002, 'A', '001-001');
INSERT INTO location VALUES ('0072080149070', 0003, 'A', '002-001');
INSERT INTO location VALUES ('0490000561430', 0001, 'A', '002-002');
INSERT INTO location VALUES ('0490000561430', 0003, 'A', '001-001');
INSERT INTO location VALUES ('0032040189020', 0001, 'A', '001-003');
INSERT INTO location VALUES ('0032040189020', 0002, 'A', '002-001');
INSERT INTO location VALUES ('0932040189020', 0001, 'C', '001-001');
INSERT INTO location VALUES ('0932040189020', 0002, 'C', '002-001');
INSERT INTO location VALUES ('0467264854126', 0002, 'A', '001-005');
INSERT INTO location VALUES ('0832040179810', 0003, 'C', '001-003');
INSERT INTO location VALUES ('0302040189887', 0003, 'E', '002-003');
INSERT INTO location VALUES ('0547896321092', 0003, 'E', '001-001');

