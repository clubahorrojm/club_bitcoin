--
-- PostgreSQL database dump
--

-- Dumped from database version 9.3.17
-- Dumped by pg_dump version 9.3.17
-- Started on 2017-08-14 16:19:16 VET

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 195 (class 1259 OID 18069)
-- Name: ref_rel_pagos_bitcoins; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE ref_rel_pagos_bitcoins (
    id integer NOT NULL,
    codigo integer,
    usuario_id integer,
    monto double precision,
    estatus integer,
    dir_monedero character varying(34),
    fecha_pago character varying(20),
    operador_id integer,
    fecha_verificacion character varying(20),
    perfil_id integer,
    hora_pago character varying(12)
);


--
-- TOC entry 196 (class 1259 OID 18072)
-- Name: ref_rel_pagos_bitcoins_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE ref_rel_pagos_bitcoins_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2113 (class 0 OID 0)
-- Dependencies: 196
-- Name: ref_rel_pagos_bitcoins_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE ref_rel_pagos_bitcoins_id_seq OWNED BY ref_rel_pagos_bitcoins.id;


--
-- TOC entry 1997 (class 2604 OID 18116)
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY ref_rel_pagos_bitcoins ALTER COLUMN id SET DEFAULT nextval('ref_rel_pagos_bitcoins_id_seq'::regclass);


--
-- TOC entry 2107 (class 0 OID 18069)
-- Dependencies: 195
-- Data for Name: ref_rel_pagos_bitcoins; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO ref_rel_pagos_bitcoins (id, codigo, usuario_id, monto, estatus, dir_monedero, fecha_pago, operador_id, fecha_verificacion, perfil_id, hora_pago) VALUES (1, 1, 15, 1000, 2, 'jE4Fcg57HhfW2rrF56vdeEfTkOpL2MbScF', '2017-08-24', 14, '2017-08-01', 13, NULL);
INSERT INTO ref_rel_pagos_bitcoins (id, codigo, usuario_id, monto, estatus, dir_monedero, fecha_pago, operador_id, fecha_verificacion, perfil_id, hora_pago) VALUES (2, 2, 17, NULL, 99, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO ref_rel_pagos_bitcoins (id, codigo, usuario_id, monto, estatus, dir_monedero, fecha_pago, operador_id, fecha_verificacion, perfil_id, hora_pago) VALUES (3, 3, 16, NULL, 99, NULL, NULL, NULL, NULL, NULL, NULL);


--
-- TOC entry 2114 (class 0 OID 0)
-- Dependencies: 196
-- Name: ref_rel_pagos_bitcoins_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('ref_rel_pagos_bitcoins_id_seq', 1, false);


--
-- TOC entry 1999 (class 2606 OID 18139)
-- Name: pagos_bit_key; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY ref_rel_pagos_bitcoins
    ADD CONSTRAINT pagos_bit_key PRIMARY KEY (id);


-- Completed on 2017-08-14 16:19:16 VET

--
-- PostgreSQL database dump complete
--

