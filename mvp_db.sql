-- Create database
CREATE DATABASE IF NOT EXISTS mvp_db;
USE mvp_db;

-- Create table pembalap
CREATE TABLE IF NOT EXISTS pembalap (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    tim VARCHAR(255) NOT NULL,
    negara VARCHAR(255) NOT NULL,
    poinMusim INT DEFAULT 0,
    jumlahMenang INT DEFAULT 0
);

-- Insert data
INSERT INTO pembalap (nama, tim, negara, poinMusim, jumlahMenang) VALUES
('Lewis Hamilton', 'Mercedes', 'United Kingdom', 347, 11),
('Max Verstappen', 'Red Bull', 'Netherlands', 335, 10),
('Valtteri Bottas', 'Mercedes', 'Finland', 203, 2),
('Sergio Perez', 'Red Bull', 'Mexico', 190, 1),
('Carlos Sainz', 'Ferrari', 'Spain', 150, 0),
('Daniel Ricciardo', 'McLaren', 'Australia', 115, 1),
('Charles Leclerc', 'Ferrari', 'Monaco', 95, 0),
('Lando Norris', 'McLaren', 'United Kingdom', 88, 0),
('Pierre Gasly', 'AlphaTauri', 'France', 75, 0),
('Fernando Alonso', 'Alpine', 'Spain', 65, 0);

-- Create table sirkuit (New Table)
CREATE TABLE IF NOT EXISTS sirkuit (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    negara VARCHAR(255) NOT NULL,
    panjang_km DECIMAL(5, 2) DEFAULT 0.00
);

-- Insert data sirkuit (New Data)
INSERT INTO sirkuit (nama, negara, panjang_km) VALUES
('Silverstone', 'United Kingdom', 5.89),
('Circuit de Monaco', 'Monaco', 3.33),
('Spa-Francorchamps', 'Belgium', 7.00),
('Monza', 'Italy', 5.79),
('Suzuka', 'Japan', 5.81);