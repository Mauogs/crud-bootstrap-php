SET
    SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET
    NAMES utf8mb4;

CREATE DATABASE IF NOT EXISTS wda_crud DEFAULT CHARACTER
SET
    utf8mb4 COLLATE utf8mb4_general_ci;

USE wda_crud;

CREATE TABLE
    IF NOT EXISTS clientes (
        id INT AUTO_INCREMENT NOT NULL,
        nome VARCHAR(100) NOT NULL,
        cpf VARCHAR(14) NOT NULL,
        aniversario VARCHAR(10) NOT NULL,
        endereco VARCHAR(100) NOT NULL,
        bairro VARCHAR(100) NOT NULL,
        cep VARCHAR(9) NOT NULL,
        cidade VARCHAR(100) NOT NULL,
        estado VARCHAR(2) NOT NULL,
        telefone VARCHAR(15) NOT NULL,
        celular VARCHAR(15) NOT NULL,
        ie VARCHAR(11) NOT NULL,
        foto VARCHAR(100),
        datacad DATETIME NOT NULL,
        modificacao DATETIME NOT NULL,
        PRIMARY KEY (id)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

INSERT INTO
    clientes (
        nome,
        cpf,
        aniversario,
        endereco,
        bairro,
        cep,
        cidade,
        estado,
        telefone,
        celular,
        ie,
        foto,
        datacad,
        modificacao
    )
VALUES
    (
        'Emerson',
        '123.456.789-00',
        '01/01/2000',
        'Rua da Lua, 123',
        'Jardim lunar',
        '12345-678',
        'Sorocaba',
        'SP',
        '(12) 34567-8900',
        '(12) 34567-8900',
        '123.456.789',
        'homem.png',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Júlia',
        '123.456.789-00',
        '01/01/2000',
        'Avenida do Sol, 321',
        'Centro',
        '87654-321',
        'Votorantim',
        'SP',
        '(00) 98765-4321',
        '(00) 98765-4321',
        '123.456.789',
        'mulher.png',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Ana',
        '000.000.000-00',
        '01/01/2000',
        'Rua Exemplo, 100',
        'Centro',
        '00000-000',
        'São Paulo',
        'SP',
        '(00) 00000-0000',
        '(00) 00000-0000',
        '123456789',
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Carlos',
        '000.000.000-00',
        '01/01/2000',
        'Av. Principal, 101',
        'Jardim América',
        '00000-000',
        'Campinas',
        'RJ',
        '(00) 00000-0000',
        '(00) 00000-0000',
        '123456789',
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Beatriz',
        '000.000.000-00',
        '01/01/2000',
        'Travessa do Sol, 102',
        'Parque das Árvores',
        '00000-000',
        'Sorocaba',
        'MG',
        '(00) 00000-0000',
        '(00) 00000-0000',
        '123456789',
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Daniel',
        '000.000.000-00',
        '01/01/2000',
        'Alameda Central, 103',
        'Bela Vista',
        '00000-000',
        'Recife',
        'PE',
        '(00) 00000-0000',
        '(00) 00000-0000',
        '123456789',
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Fernanda',
        '000.000.000-00',
        '01/01/2000',
        'Rua Exemplo, 104',
        'Centro',
        '00000-000',
        'São Paulo',
        'RS',
        '(00) 00000-0000',
        '(00) 00000-0000',
        '123456789',
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Eduardo',
        '000.000.000-00',
        '01/01/2000',
        'Av. Principal, 105',
        'Jardim América',
        '00000-000',
        'Campinas',
        'SP',
        '(00) 00000-0000',
        '(00) 00000-0000',
        '123456789',
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Marina',
        '000.000.000-00',
        '01/01/2000',
        'Travessa do Sol, 106',
        'Parque das Árvores',
        '00000-000',
        'Sorocaba',
        'RJ',
        '(00) 00000-0000',
        '(00) 00000-0000',
        '123456789',
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Lucas',
        '000.000.000-00',
        '01/01/2000',
        'Alameda Central, 107',
        'Bela Vista',
        '00000-000',
        'Recife',
        'MG',
        '(00) 00000-0000',
        '(00) 00000-0000',
        '123456789',
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Juliana',
        '000.000.000-00',
        '01/01/2000',
        'Rua Exemplo, 108',
        'Centro',
        '00000-000',
        'São Paulo',
        'PE',
        '(00) 00000-0000',
        '(00) 00000-0000',
        '123456789',
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Thiago',
        '000.000.000-00',
        '01/01/2000',
        'Av. Principal, 109',
        'Jardim América',
        '00000-000',
        'Campinas',
        'RS',
        '(00) 00000-0000',
        '(00) 00000-0000',
        '123456789',
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Ana',
        '000.000.000-00',
        '01/01/2000',
        'Travessa do Sol, 110',
        'Parque das Árvores',
        '00000-000',
        'Sorocaba',
        'SP',
        '(00) 00000-0000',
        '(00) 00000-0000',
        '123456789',
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Carlos',
        '000.000.000-00',
        '01/01/2000',
        'Alameda Central, 111',
        'Bela Vista',
        '00000-000',
        'Recife',
        'RJ',
        '(00) 00000-0000',
        '(00) 00000-0000',
        '123456789',
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Beatriz',
        '000.000.000-00',
        '01/01/2000',
        'Rua Exemplo, 112',
        'Centro',
        '00000-000',
        'São Paulo',
        'MG',
        '(00) 00000-0000',
        '(00) 00000-0000',
        '123456789',
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Daniel',
        '000.000.000-00',
        '01/01/2000',
        'Av. Principal, 113',
        'Jardim América',
        '00000-000',
        'Campinas',
        'PE',
        '(00) 00000-0000',
        '(00) 00000-0000',
        '123456789',
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Fernanda',
        '000.000.000-00',
        '01/01/2000',
        'Travessa do Sol, 114',
        'Parque das Árvores',
        '00000-000',
        'Sorocaba',
        'RS',
        '(00) 00000-0000',
        '(00) 00000-0000',
        '123456789',
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Eduardo',
        '000.000.000-00',
        '01/01/2000',
        'Alameda Central, 115',
        'Bela Vista',
        '00000-000',
        'Recife',
        'SP',
        '(00) 00000-0000',
        '(00) 00000-0000',
        '123456789',
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Marina',
        '000.000.000-00',
        '01/01/2000',
        'Rua Exemplo, 116',
        'Centro',
        '00000-000',
        'São Paulo',
        'RJ',
        '(00) 00000-0000',
        '(00) 00000-0000',
        '123456789',
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Lucas',
        '000.000.000-00',
        '01/01/2000',
        'Av. Principal, 117',
        'Jardim América',
        '00000-000',
        'Campinas',
        'MG',
        '(00) 00000-0000',
        '(00) 00000-0000',
        '123456789',
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Juliana',
        '000.000.000-00',
        '01/01/2000',
        'Travessa do Sol, 118',
        'Parque das Árvores',
        '00000-000',
        'Sorocaba',
        'PE',
        '(00) 00000-0000',
        '(00) 00000-0000',
        '123456789',
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Thiago',
        '000.000.000-00',
        '01/01/2000',
        'Alameda Central, 119',
        'Bela Vista',
        '00000-000',
        'Recife',
        'RS',
        '(00) 00000-0000',
        '(00) 00000-0000',
        '123456789',
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Ana',
        '000.000.000-00',
        '01/01/2000',
        'Rua Exemplo, 120',
        'Centro',
        '00000-000',
        'São Paulo',
        'SP',
        '(00) 00000-0000',
        '(00) 00000-0000',
        '123456789',
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Carlos',
        '000.000.000-00',
        '01/01/2000',
        'Av. Principal, 121',
        'Jardim América',
        '00000-000',
        'Campinas',
        'RJ',
        '(00) 00000-0000',
        '(00) 00000-0000',
        '123456789',
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Beatriz',
        '000.000.000-00',
        '01/01/2000',
        'Travessa do Sol, 122',
        'Parque das Árvores',
        '00000-000',
        'Sorocaba',
        'MG',
        '(00) 00000-0000',
        '(00) 00000-0000',
        '123456789',
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Daniel',
        '000.000.000-00',
        '01/01/2000',
        'Alameda Central, 123',
        'Bela Vista',
        '00000-000',
        'Recife',
        'PE',
        '(00) 00000-0000',
        '(00) 00000-0000',
        '123456789',
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Fernanda',
        '000.000.000-00',
        '01/01/2000',
        'Rua Exemplo, 124',
        'Centro',
        '00000-000',
        'São Paulo',
        'RS',
        '(00) 00000-0000',
        '(00) 00000-0000',
        '123456789',
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Eduardo',
        '000.000.000-00',
        '01/01/2000',
        'Av. Principal, 125',
        'Jardim América',
        '00000-000',
        'Campinas',
        'SP',
        '(00) 00000-0000',
        '(00) 00000-0000',
        '123456789',
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Marina',
        '000.000.000-00',
        '01/01/2000',
        'Travessa do Sol, 126',
        'Parque das Árvores',
        '00000-000',
        'Sorocaba',
        'RJ',
        '(00) 00000-0000',
        '(00) 00000-0000',
        '123456789',
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Lucas',
        '000.000.000-00',
        '01/01/2000',
        'Alameda Central, 127',
        'Bela Vista',
        '00000-000',
        'Recife',
        'MG',
        '(00) 00000-0000',
        '(00) 00000-0000',
        '123456789',
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    );

CREATE TABLE
    IF NOT EXISTS carros (
        id INT AUTO_INCREMENT NOT NULL,
        marca VARCHAR(30) NOT NULL,
        modelo VARCHAR(50) NOT NULL,
        ano INT NOT NULL,
        foto VARCHAR(100),
        datacad DATETIME NOT NULL,
        modificacao DATETIME NOT NULL,
        PRIMARY KEY (id)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

INSERT INTO
    carros (marca, modelo, ano, foto, datacad, modificacao)
VALUES
    (
        'Lamborghini',
        'Urus',
        2018,
        'urus.png',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Ferrari',
        'Purosangue',
        2022,
        'purosangue.png',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Honda',
        'Civic',
        2000,
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Chevrolet',
        'Onix',
        2001,
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Toyota',
        'Corolla',
        2002,
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Ford',
        'Ka',
        2003,
        '.png',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Volkswagen',
        'Gol',
        2004,
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Fiat',
        'Argo',
        2005,
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Nissan',
        'Versa',
        2006,
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Honda',
        'Civic',
        2007,
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Chevrolet',
        'Onix',
        2008,
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Toyota',
        'Corolla',
        2009,
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Ford',
        'Ka',
        2010,
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Volkswagen',
        'Gol',
        2011,
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Fiat',
        'Argo',
        2012,
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Nissan',
        'Versa',
        2013,
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Honda',
        'Civic',
        2014,
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Chevrolet',
        'Onix',
        2015,
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Toyota',
        'Corolla',
        2016,
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Ford',
        'Ka',
        2017,
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Volkswagen',
        'Gol',
        2018,
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Fiat',
        'Argo',
        2019,
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Nissan',
        'Versa',
        2020,
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Honda',
        'Civic',
        2021,
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Chevrolet',
        'Onix',
        2022,
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Toyota',
        'Corolla',
        2023,
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Ford',
        'Ka',
        2024,
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Volkswagen',
        'Gol',
        2000,
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Fiat',
        'Argo',
        2001,
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    ),
    (
        'Nissan',
        'Versa',
        2002,
        '',
        '2025-01-01 00:00:00',
        '2025-01-01 00:00:00'
    );

CREATE TABLE
    IF NOT EXISTS usuarios (
        id INT AUTO_INCREMENT NOT NULL,
        nome VARCHAR(50) NOT NULL,
        usuario VARCHAR(50) NOT NULL,
        senha VARCHAR(100) NOT NULL,
        foto VARCHAR(50),
        PRIMARY KEY (id)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

INSERT INTO
    usuarios (nome, usuario, senha, foto)
VALUES
    (
        'Administrador',
        'admin',
        '2aAnwG7BO/.7I',
        'administrador.png'
    ),
    ('João', 'João', '2a3jG2Iz75uPs', 'macaco.png'),
    ('Ana', 'ana0', 'senha0', ''),
    ('Carlos', 'carlos1', 'senha1', ''),
    ('Beatriz', 'beatriz2', 'senha2', ''),
    ('Daniel', 'daniel3', 'senha3', ''),
    ('Fernanda ', 'fernanda4', 'senha4', ''),
    ('Eduardo', 'eduardo5', 'senha5', ''),
    ('Ana', 'ana6', 'senha6', ''),
    ('Carlos', 'carlos7', 'senha7', ''),
    ('Beatriz', 'beatriz8', 'senha8', ''),
    ('Daniel', 'daniel9', 'senha9', ''),
    ('Fernanda', 'fernanda10', 'senha10', ''),
    ('Eduardo', 'eduardo11', 'senha11', ''),
    ('Ana', 'ana12', 'senha12', ''),
    ('Carlos', 'carlos13', 'senha13', ''),
    ('Beatriz', 'beatriz14', 'senha14', ''),
    ('Daniel', 'daniel15', 'senha15', ''),
    ('Fernanda', 'fernanda16', 'senha16', ''),
    ('Eduardo', 'eduardo17', 'senha17', ''),
    ('Ana', 'ana18', 'senha18', ''),
    ('Carlos', 'carlos19', 'senha19', ''),
    ('Beatriz', 'beatriz20', 'senha20', ''),
    ('Daniel', 'daniel21', 'senha21', ''),
    ('Fernanda', 'fernanda22', 'senha22', ''),
    ('Eduardo', 'eduardo23', 'senha23', ''),
    ('Ana', 'ana24', 'senha24', ''),
    ('Carlos', 'carlos25', 'senha25', ''),
    ('Beatriz', 'beatriz26', 'senha26', ''),
    ('Daniel', 'daniel27', 'senha27', '');
COMMIT;