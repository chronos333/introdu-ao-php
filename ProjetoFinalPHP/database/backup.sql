--
-- PostgreSQL database dump
--

\restrict LqXbOwRhw2JfwhDCa6Qulest096TCb68nhdq9LSTfO64OmIOJbKLFZkkFMFb306

-- Dumped from database version 18.4
-- Dumped by pg_dump version 18.4

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: jogos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.jogos (
    id integer NOT NULL,
    nome character varying(255) NOT NULL,
    preco numeric(10,2) NOT NULL,
    genero character varying(50) NOT NULL,
    imagem text,
    descricao text,
    avaliacao numeric(2,1) DEFAULT 0,
    requisitos text
);


ALTER TABLE public.jogos OWNER TO postgres;

--
-- Name: jogos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.jogos_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.jogos_id_seq OWNER TO postgres;

--
-- Name: jogos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.jogos_id_seq OWNED BY public.jogos.id;


--
-- Name: pedidos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pedidos (
    id integer NOT NULL,
    usuario_id integer NOT NULL,
    jogo_id integer NOT NULL,
    quantidade integer DEFAULT 1 NOT NULL,
    preco_unitario numeric(10,2) NOT NULL,
    data_pedido timestamp without time zone DEFAULT now()
);


ALTER TABLE public.pedidos OWNER TO postgres;

--
-- Name: pedidos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.pedidos_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.pedidos_id_seq OWNER TO postgres;

--
-- Name: pedidos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pedidos_id_seq OWNED BY public.pedidos.id;


--
-- Name: usuarios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuarios (
    id integer NOT NULL,
    nome character varying(255) NOT NULL,
    senha character varying(255) NOT NULL,
    is_admin boolean DEFAULT false
);


ALTER TABLE public.usuarios OWNER TO postgres;

--
-- Name: usuarios_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.usuarios_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.usuarios_id_seq OWNER TO postgres;

--
-- Name: usuarios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.usuarios_id_seq OWNED BY public.usuarios.id;


--
-- Name: jogos id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jogos ALTER COLUMN id SET DEFAULT nextval('public.jogos_id_seq'::regclass);


--
-- Name: pedidos id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pedidos ALTER COLUMN id SET DEFAULT nextval('public.pedidos_id_seq'::regclass);


--
-- Name: usuarios id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios ALTER COLUMN id SET DEFAULT nextval('public.usuarios_id_seq'::regclass);


--
-- Data for Name: jogos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.jogos (id, nome, preco, genero, imagem, descricao, avaliacao, requisitos) FROM stdin;
7	The Last of Us	15.00	Suspense	https://upload.wikimedia.org/wikipedia/pt/thumb/b/be/The_Last_of_Us_capa.png/330px-The_Last_of_Us_capa.png	\N	0.0	\N
13	Outlast	5.00	Terror	https://miro.medium.com/v2/resize:fit:1400/1*8v-QkIhZd9gYr6ARXnalcg@2x.jpeg	Outlast ├® um jogo de survival horror em primeira pessoa onde voc├¬ controla um jornalista investigativo sem armas de combate. Preso em um asilo psiqui├ítrico abandonado e manipulado por uma corpora├º├úo secreta, seu ├║nico recurso para sobreviver e registrar os horrores do local ├® uma c├ómera com vis├úo noturna.	0.0	\N
6	hades	5.00	roguelike	https://upload.wikimedia.org/wikipedia/en/c/cc/Hades_cover_art.jpg	\N	0.0	\N
12	LEGO Batman: Legacy of the Dark Knight	15.00	lego	https://wallpapercave.com/wp/wp16013508.jpg	Torne-se o Cavaleiro das Trevas e enfrente os supervil├Áes mais infames de Gotham City. Nesta aventura de a├º├úo em mundo aberto do premiado est├║dio TT Games	0.0	\N
11	UFC5	15.00	Esporte	https://s2-ge.glbimg.com/f0JLZtoATD4OF2FULsaeIteGpfc=/0x0:1920x1080/984x0/smart/filters:strip_icc()/i.s3.glbimg.com/v1/AUTH_bc8228b6673f488aa253bbcb03c80ec5/internal_photos/bs/2023/z/j/dxRaJXR8envQa2zaCGTw/ea-ufc5-std-fp-rgb-horizontal-1920x1080.jpg	\N	0.0	\N
8	Red Dead Redemption 2	15.00	a├ºao	https://s2-techtudo.glbimg.com/cpnvapPE7mpqJ61v2ZYMlVaEtH4=/0x0:1920x1080/984x0/smart/filters:strip_icc()/i.s3.glbimg.com/v1/AUTH_08fbf48bc0524877943fe86e43087e7a/internal_photos/bs/2018/m/3/bil5pBSmSMzyxtIRTyIw/red.jpg	\N	0.0	\N
18	Peak	5.00	Aventura	https://m.media-amazon.com/images/M/MV5BODk5NWU4NDktNDE1OS00YzJiLTlkZjItMDAyZmNjMTBiOGU5XkEyXkFqcGc@._V1_.jpg	PEAK ├® um jogo cooperativo de escalada onde o menor erro pode custar a sua vida. Sozinho ou em grupo, sua ├║nica esperan├ºa de resgate em uma ilha misteriosa	0.0	\N
17	Fifa 26	20.00	Esporte	https://img.youtube.com/vi/0GE8YCIQF2M/maxresdefault.jpg	Coloque seu time dos sonhos ├á prova no Football Ultimate Team, com Tournaments e Live Events, al├®m de uma experi├¬ncia renovada de Rivals e Champions.	0.0	\N
15	Read or not	15.00	FPS	https://i.ytimg.com/vi/4xiAtFT6u0M/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLC1M3VgOQbW2mUlCu0TmJQ2e4YLkg	Ready or Not ├® um jogo de tiro t├ítico em primeira pessoa que simula opera├º├Áes da SWAT. Os jogadores enfrentam situa├º├Áes de alto risco e dilemas morais em uma cidade ca├│tica, exigindo planejamento rigoroso, coopera├º├úo e uso correto de equipamentos do mundo real para conter o crime e resgatar ref├®ns.	0.0	\N
14	God of War ragnarok	15.00	RPG	https://m.media-amazon.com/images/I/71KH6odlvuL._AC_UF350,350_QL80_.jpg	A sequ├¬ncia do aclamado God of War (2018), God of War Ragnar├Âk retoma a hist├│ria com o Fimbulwinter em curso. Kratos e Atreus devem viajar pelos Nove Reinos	0.0	\N
19	Rematch	15.00	Esporte	https://i.ytimg.com/vi/CxDdATPlQI8/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLAhU2dHaToC_3rA9Ii2N7ksp7OWUg	Rematch ├® um jogo de futebol multiplayer estilo arcade desenvolvido pela Sloclap (a mesma de Sifu). Focado em partidas r├ípidas 5v5, voc├¬ controla um ├║nico atleta em terceira pessoa. O game possui uma pegada competitiva, din├ómica e muito estrat├®gica.	0.0	...
16	schedule	5.00	Simulator	https://sm.ign.com/ign_br/screenshot/default/1200-800_h7j1.jpg	Manufacture and distribute a range of drugs throughout the grungy city of Hyland Point. Expand your empire with properties, businesses, employees and more.	0.0	
\.


--
-- Data for Name: pedidos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pedidos (id, usuario_id, jogo_id, quantidade, preco_unitario, data_pedido) FROM stdin;
1	6	18	1	5.00	2026-06-11 13:28:11.081324
\.


--
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.usuarios (id, nome, senha, is_admin) FROM stdin;
6	pini	$2y$12$Tp59pIBJTNhC/qUur5WG4.BNWMPdNVhHVxSi5mwKErsTDPch0nv3W	t
7	pedro	$2y$12$NOUl6WIXi7LhnV3orEw4l.jC2UMGzLKG2eCxQZERzHSeam4nd1C0m	t
11	Turma Teste	$2y$12$UhTchdAbotndqXX7afBhQ.OAi8npkCQZGdiAkJOOVz5aCQ1vkxPWC	t
\.


--
-- Name: jogos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.jogos_id_seq', 19, true);


--
-- Name: pedidos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pedidos_id_seq', 1, true);


--
-- Name: usuarios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.usuarios_id_seq', 11, true);


--
-- Name: jogos jogos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jogos
    ADD CONSTRAINT jogos_pkey PRIMARY KEY (id);


--
-- Name: pedidos pedidos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pedidos
    ADD CONSTRAINT pedidos_pkey PRIMARY KEY (id);


--
-- Name: usuarios usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id);


--
-- PostgreSQL database dump complete
--

\unrestrict LqXbOwRhw2JfwhDCa6Qulest096TCb68nhdq9LSTfO64OmIOJbKLFZkkFMFb306

