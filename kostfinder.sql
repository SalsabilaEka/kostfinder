PGDMP                      }         
   kostfinder    16.2    16.2 D    �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    19333 
   kostfinder    DATABASE     �   CREATE DATABASE kostfinder WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'English_Indonesia.1252';
    DROP DATABASE kostfinder;
                postgres    false                        3079    21149    postgis 	   EXTENSION     ;   CREATE EXTENSION IF NOT EXISTS postgis WITH SCHEMA public;
    DROP EXTENSION postgis;
                   false            �           0    0    EXTENSION postgis    COMMENT     ^   COMMENT ON EXTENSION postgis IS 'PostGIS geometry and geography spatial types and functions';
                        false    2            �            1259    24707    failed_jobs    TABLE     &  CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);
    DROP TABLE public.failed_jobs;
       public         heap    postgres    false            �            1259    24706    failed_jobs_id_seq    SEQUENCE     {   CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.failed_jobs_id_seq;
       public          postgres    false    227            �           0    0    failed_jobs_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;
          public          postgres    false    226            �            1259    24766    fakultas    TABLE     �   CREATE TABLE public.fakultas (
    universitas character varying(50),
    fakultas character varying(64),
    latitude real,
    longitude real
);
    DROP TABLE public.fakultas;
       public         heap    postgres    false            �            1259    24680 
   migrations    TABLE     �   CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);
    DROP TABLE public.migrations;
       public         heap    postgres    false            �            1259    24679    migrations_id_seq    SEQUENCE     �   CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.migrations_id_seq;
       public          postgres    false    222            �           0    0    migrations_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;
          public          postgres    false    221            �            1259    24699    password_reset_tokens    TABLE     �   CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);
 )   DROP TABLE public.password_reset_tokens;
       public         heap    postgres    false            �            1259    24719    personal_access_tokens    TABLE     �  CREATE TABLE public.personal_access_tokens (
    id bigint NOT NULL,
    tokenable_type character varying(255) NOT NULL,
    tokenable_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    token character varying(64) NOT NULL,
    abilities text,
    last_used_at timestamp(0) without time zone,
    expires_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 *   DROP TABLE public.personal_access_tokens;
       public         heap    postgres    false            �            1259    24718    personal_access_tokens_id_seq    SEQUENCE     �   CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE public.personal_access_tokens_id_seq;
       public          postgres    false    229            �           0    0    personal_access_tokens_id_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;
          public          postgres    false    228            �            1259    24769    table_point    TABLE       CREATE TABLE public.table_point (
    nama character varying(50),
    alamat character varying(256),
    pemilik character varying(50),
    telepon character varying(50),
    jenis character varying(50),
    harga integer,
    tunai boolean,
    transfer boolean,
    ewallet boolean,
    lbangunan real,
    ltanah real,
    jenissertifikat character varying(50),
    ac boolean,
    kasur boolean,
    mejakursi boolean,
    kamarmandi boolean,
    lemari boolean,
    wifi boolean,
    dapur boolean,
    kulkas boolean,
    ruangtamu boolean,
    parkirmotor boolean,
    parkirmobil boolean,
    cctv boolean,
    keamanan boolean,
    listrik character varying(50),
    air character varying(50),
    jammalam character varying(50),
    ketjammalam character varying(64),
    foto character varying(256),
    latitude real,
    longitude real,
    id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    user_name character varying(255),
    geom public.geography(Point,4326)
);
    DROP TABLE public.table_point;
       public         heap    postgres    false    2    2    2    2    2    2    2    2            �            1259    24781    table-point_id_seq    SEQUENCE     �   CREATE SEQUENCE public."table-point_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public."table-point_id_seq";
       public          postgres    false    236            �           0    0    table-point_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public."table-point_id_seq" OWNED BY public.table_point.id;
          public          postgres    false    237            �            1259    24763    table_halte    TABLE     l   CREATE TABLE public.table_halte (
    id integer,
    nama character varying(50),
    x real,
    y real
);
    DROP TABLE public.table_halte;
       public         heap    postgres    false            �            1259    24749    table_polygons    TABLE     2  CREATE TABLE public.table_polygons (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    description text,
    geom public.geography(Geometry,4326) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    image character varying(255)
);
 "   DROP TABLE public.table_polygons;
       public         heap    postgres    false    2    2    2    2    2    2    2    2            �            1259    24748    table_polygons_id_seq    SEQUENCE     ~   CREATE SEQUENCE public.table_polygons_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.table_polygons_id_seq;
       public          postgres    false    233            �           0    0    table_polygons_id_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.table_polygons_id_seq OWNED BY public.table_polygons.id;
          public          postgres    false    232            �            1259    24740    table_polyline    TABLE     2  CREATE TABLE public.table_polyline (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    description text,
    geom public.geography(Geometry,4326) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    image character varying(255)
);
 "   DROP TABLE public.table_polyline;
       public         heap    postgres    false    2    2    2    2    2    2    2    2            �            1259    24739    table_polyline_id_seq    SEQUENCE     ~   CREATE SEQUENCE public.table_polyline_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.table_polyline_id_seq;
       public          postgres    false    231            �           0    0    table_polyline_id_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.table_polyline_id_seq OWNED BY public.table_polyline.id;
          public          postgres    false    230            �            1259    24687    users    TABLE     �  CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    phone character varying(255),
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.users;
       public         heap    postgres    false            �            1259    24686    users_id_seq    SEQUENCE     u   CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.users_id_seq;
       public          postgres    false    224            �           0    0    users_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;
          public          postgres    false    223                       2604    24710    failed_jobs id    DEFAULT     p   ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);
 =   ALTER TABLE public.failed_jobs ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    226    227    227                       2604    24683    migrations id    DEFAULT     n   ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);
 <   ALTER TABLE public.migrations ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    221    222    222                       2604    24722    personal_access_tokens id    DEFAULT     �   ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);
 H   ALTER TABLE public.personal_access_tokens ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    228    229    229                       2604    24782    table_point id    DEFAULT     r   ALTER TABLE ONLY public.table_point ALTER COLUMN id SET DEFAULT nextval('public."table-point_id_seq"'::regclass);
 =   ALTER TABLE public.table_point ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    237    236                       2604    24752    table_polygons id    DEFAULT     v   ALTER TABLE ONLY public.table_polygons ALTER COLUMN id SET DEFAULT nextval('public.table_polygons_id_seq'::regclass);
 @   ALTER TABLE public.table_polygons ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    232    233    233                       2604    24743    table_polyline id    DEFAULT     v   ALTER TABLE ONLY public.table_polyline ALTER COLUMN id SET DEFAULT nextval('public.table_polyline_id_seq'::regclass);
 @   ALTER TABLE public.table_polyline ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    231    230    231                       2604    24690    users id    DEFAULT     d   ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);
 7   ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    223    224    224            �          0    24707    failed_jobs 
   TABLE DATA           a   COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
    public          postgres    false    227   �T       �          0    24766    fakultas 
   TABLE DATA           N   COPY public.fakultas (universitas, fakultas, latitude, longitude) FROM stdin;
    public          postgres    false    235   �T       �          0    24680 
   migrations 
   TABLE DATA           :   COPY public.migrations (id, migration, batch) FROM stdin;
    public          postgres    false    222   �V       �          0    24699    password_reset_tokens 
   TABLE DATA           I   COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
    public          postgres    false    225   �W       �          0    24719    personal_access_tokens 
   TABLE DATA           �   COPY public.personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, expires_at, created_at, updated_at) FROM stdin;
    public          postgres    false    229   �W                 0    21467    spatial_ref_sys 
   TABLE DATA           X   COPY public.spatial_ref_sys (srid, auth_name, auth_srid, srtext, proj4text) FROM stdin;
    public          postgres    false    217   X       �          0    24763    table_halte 
   TABLE DATA           5   COPY public.table_halte (id, nama, x, y) FROM stdin;
    public          postgres    false    234   X       �          0    24769    table_point 
   TABLE DATA           r  COPY public.table_point (nama, alamat, pemilik, telepon, jenis, harga, tunai, transfer, ewallet, lbangunan, ltanah, jenissertifikat, ac, kasur, mejakursi, kamarmandi, lemari, wifi, dapur, kulkas, ruangtamu, parkirmotor, parkirmobil, cctv, keamanan, listrik, air, jammalam, ketjammalam, foto, latitude, longitude, id, created_at, updated_at, user_name, geom) FROM stdin;
    public          postgres    false    236   ,f       �          0    24749    table_polygons 
   TABLE DATA           d   COPY public.table_polygons (id, name, description, geom, created_at, updated_at, image) FROM stdin;
    public          postgres    false    233   �       �          0    24740    table_polyline 
   TABLE DATA           d   COPY public.table_polyline (id, name, description, geom, created_at, updated_at, image) FROM stdin;
    public          postgres    false    231   �       �          0    24687    users 
   TABLE DATA           |   COPY public.users (id, name, phone, email, email_verified_at, password, remember_token, created_at, updated_at) FROM stdin;
    public          postgres    false    224   �       �           0    0    failed_jobs_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);
          public          postgres    false    226            �           0    0    migrations_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.migrations_id_seq', 8, true);
          public          postgres    false    221            �           0    0    personal_access_tokens_id_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public.personal_access_tokens_id_seq', 1, false);
          public          postgres    false    228            �           0    0    table-point_id_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public."table-point_id_seq"', 55, true);
          public          postgres    false    237            �           0    0    table_polygons_id_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.table_polygons_id_seq', 1, false);
          public          postgres    false    232            �           0    0    table_polyline_id_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.table_polyline_id_seq', 1, false);
          public          postgres    false    230            �           0    0    users_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.users_id_seq', 2, true);
          public          postgres    false    223            ,           2606    24715    failed_jobs failed_jobs_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_pkey;
       public            postgres    false    227            .           2606    24717 #   failed_jobs failed_jobs_uuid_unique 
   CONSTRAINT     ^   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);
 M   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_uuid_unique;
       public            postgres    false    227            "           2606    24685    migrations migrations_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.migrations DROP CONSTRAINT migrations_pkey;
       public            postgres    false    222            *           2606    24705 0   password_reset_tokens password_reset_tokens_pkey 
   CONSTRAINT     q   ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);
 Z   ALTER TABLE ONLY public.password_reset_tokens DROP CONSTRAINT password_reset_tokens_pkey;
       public            postgres    false    225            0           2606    24726 2   personal_access_tokens personal_access_tokens_pkey 
   CONSTRAINT     p   ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);
 \   ALTER TABLE ONLY public.personal_access_tokens DROP CONSTRAINT personal_access_tokens_pkey;
       public            postgres    false    229            2           2606    24729 :   personal_access_tokens personal_access_tokens_token_unique 
   CONSTRAINT     v   ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);
 d   ALTER TABLE ONLY public.personal_access_tokens DROP CONSTRAINT personal_access_tokens_token_unique;
       public            postgres    false    229            9           2606    24784    table_point table-point_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.table_point
    ADD CONSTRAINT "table-point_pkey" PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.table_point DROP CONSTRAINT "table-point_pkey";
       public            postgres    false    236            7           2606    24756 "   table_polygons table_polygons_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.table_polygons
    ADD CONSTRAINT table_polygons_pkey PRIMARY KEY (id);
 L   ALTER TABLE ONLY public.table_polygons DROP CONSTRAINT table_polygons_pkey;
       public            postgres    false    233            5           2606    24747 "   table_polyline table_polyline_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.table_polyline
    ADD CONSTRAINT table_polyline_pkey PRIMARY KEY (id);
 L   ALTER TABLE ONLY public.table_polyline DROP CONSTRAINT table_polyline_pkey;
       public            postgres    false    231            $           2606    24698    users users_email_unique 
   CONSTRAINT     T   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);
 B   ALTER TABLE ONLY public.users DROP CONSTRAINT users_email_unique;
       public            postgres    false    224            &           2606    24696    users users_phone_unique 
   CONSTRAINT     T   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_phone_unique UNIQUE (phone);
 B   ALTER TABLE ONLY public.users DROP CONSTRAINT users_phone_unique;
       public            postgres    false    224            (           2606    24694    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public            postgres    false    224            3           1259    24727 8   personal_access_tokens_tokenable_type_tokenable_id_index    INDEX     �   CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);
 L   DROP INDEX public.personal_access_tokens_tokenable_type_tokenable_id_index;
       public            postgres    false    229    229            �      x������ � �      �   +  x��TۊA}֯�0����
�n�`�R�^��-̅e�>�Nר�B�=u�ԩS�[�'/��Em��uQ�䋞k%�PJɜ�o1�]��K�C��*���oOU�p"b������Ho,7�W	�-�A7�T$5�&R��>4����R<��������rԩ#%����(�l���bFq&-�`�u�8y����|PcuS�T�ܾ�;�@5߭;B���~@9t���������S�(F��2[zܣ�z\	�+^�;��L��#̭�c� X��I�,g�+�à��ڸ��:8�ᇧJdA���4�ٸ&4���(�qy��Ʃ��8��6b�H�ߴ>?'^3Y�M����nUjQ+��x��-E�C,�.4�c���7���	�X.$����G�:��\Y:
��ݷ�I0��{��WC8����x,!�D^���tP{�Q�,8��f��U~x,.��l��� �e͆˽�qqe���3�'S\.΄�`��=�V����r��zfU�)��7/"����8%C��/Zi,�U[3tx������5�N�� ����      �   �   x�]��� ���|��{���PO�"p�k�}h埸����A)(	�����Md����hj�����&��Z8"�;�5TSx��0ݻ�b:�-n�^y��Ӑ��i�����X�������Qs����r&�}�b��%%HZ,���e;��z�+Ҥ���7T_[@��,�P%Lۢ�v|8ts����e���s�      �      x������ � �      �      x������ � �            x������ � �      �   �  x����r�F���S�h�Q�r,O[RS��b�"�61�$����_@&.mm}(�r�3�2�Z���r�?W������'������S�����r���]�mI�T�x}n���Ʉ�-�ͼ�V�ռ�u_����8m���3���l6պ�.*�2�������]4���Yh���SΪ�m�����������+o䂷��1+�yS̺US�]u��6�͌�&��+G�����Rf�uQn�=]LG��"� ��eq����� 39].�T���S���ri m�������j3@F{�"~1�M���[����y%X"�7v��T�z��V���R&wQ;��dH3\����!��vݦ�[��vYm&�s���r��2��8��
8W���E��o�����k���}�*�U���rPn/����r$%�N�wu����)���VR�K�3�dDa�ϕ�>"�����ᘨLo�����A%CȈ�
>��g�y�Y�W�f_���?�_����̛���I8)W1��[�\�lTІ��ʐk��l�-���9՗n;�f����JY�ky�.���5W��]�o�S���l�};�@'�<���Z��S��SN�^��
M�=���㌱1G��0%3���ʵ�n�;)��U��l3RrN��\�=Q/{T9b���D��2�̷jYm�LD��C��:f���# D��n3��䩞���F\b�
8xSi��9~�]|������bV�V�:��-��(~�h�(�j�2dtv�+�۔I��fޢ��G#@�r[��{|ɼr\眈9��������i������H��=���J�
��=�{�G��L��쮥�M���@�#Z����T�6��H*�!��2]2-G:���#�q�j���������هvW\�D6:�*�V�/G~�&�7����fU\�>|�L��5B�&�> ���$#��-s�)�(�S\�&�z�0��<0%\u�P�����S���(`�Dv��)im����}]M���P\��q�n�5.~�[7�%B��s�Q�-�"�ow�|!4�>��X�``��C�ZAe\ 9z^�G.�+�u��h�w/W��{��D�&u��.n� �n4#��x�O)��V��I�Bץ,F)\>�p���x��0s/�O5D��q�Jn$ƆM�#3�#�ݨw�U��k;�U�hXR��i �����S�m��D�(�ipF�泫�BO+��fZ#,iԕ�>���`�6�6�!g���ޟ�a�01�>��qM�G	�ZL�ڇ�������+9Ȇ���&1Kr΢�?=�|���oMd6k7_��4Sq8!֙<�	�iʵ�
������[x�4;�`��Gr4�3�EZ-�F�Ճ���E�o�h�?�j<�㤌�Y�hw�.G�����=TK��K�h�^AZ�+��,ڠ��Pc� ���O�����c�~o���*� -� �)�R)�J��9�����X�n-&��FC6Ap�*�劀�*��Qz�Ō���Sۉ�c��S�~�EG�LJ��2��m�y�mBC��Q��zNAN�i3��5=�Ϙ�m}��"e�hIyP�;N��J�(�t}5+(���D�'��S#���ݶy�������,��0�s��o"HKΩ!��7�p�Q�Y�"�0Ҧ\y�{9	7�� d@��U�:��+�N���&Ͳ�F���ˢ�V�r׭���#����8wf�X�r��.��]<7ӳ1yZ�`��>\�y��"�yd���F�Ȥt����r$y�I]"?��-��䴨m����%0��p�k2B�����]��[5e�����\�XEc�È%�<��w�jǪm��Q$t����/�㺆�VJ�t�;���;�7��f�����2�U�X�'�&��f���f{E����E��z-�AGK��OE��l�ʴ�,`�IX�J����-��9��*��7��m�s\�S�������Q�2趆g+L*h���X3Q���l����[l۷��jcF(�;��?]�|���_�i�9��	p>qO�v���L���ڏ��K`8��	`�	|���Yϛ��̐��1�K-��r$#�UO�[3/n��ZѼ!S�'�ҧ8�6T���4x@rc6iեl0Rט��-.�6�5�~ˋ�(#��� l�t}_ȋ3d5Uy�`X�����<�?��0�2;�Q�)��+N�r�h��r#ӛ�D����\!�4�gY�9h��e�i 1�'��FG�Vߦc����@}�+`�?EY^ä�0:��D��۬J��u1Hd^�	R�^�f���Y�'�V��#�k��*�Ěl9��Xy�v�b�[M��R�C	������[E����?���$�i
f�"�EzlDtx�Q.1^0~]/��ъ3J^1�4�I��0�0�Fc�S�c�#^dy$�1��u�[(��0�eG�#m\F��³�����`Q>����mNdL[zt�[o&�|���b��`b���q*�4�M5�|���?'��s�׷'o�i_�� 5$���8�RE��㉃1|��B���W���z3�%�?h�i�l��GYm�<�tÃ�κ4�Mt�<��Rǩ(�6��(��<�P%��/bƓs��Zn.�k�2hm%Ljo��ᾰ�-�-�TJj��;<;!�I3:8{���$��/���9:��ܜM�~p��nZ��5�s��^O~d�xa�A����?{�*�*�m���'�ҋǶ�O��Z������y�z�p� ^F����s�Qҵm��a֜tÊ$�/���|)~n7@���D�_1�$Н�.$;mt���C4��d(!R�C��t�p��em�4l:6��̧��˃����8�F?I?�F�<?=��R��=>ƤU>[��SGW�q���A�%�f��¡R�ƴ�U�+�� �t��oמ�����E(y�h�s�YZB(gP�|����� �lvM�'�(�"���Ϟ��as�5�8�����ܨ*iddj�p�s���ǻ!,��f����D�u��r��M�=�N�ToR���M#7	��H������u!���.5���a��M�B���z��&�99D��+<�w�����d
��绢��z"�KR��(*}�t�s�L�G8i�4P�V�i��~ןp,n|�m\���6UWVx��>|k=w�����~W�^��wN����O��ܧ!��'���o&�AIGA��D������ l@g/77�%��am�#�;C�^��[f �-G� �A�ϣ�1/7���lI��K��v���x�����>�h^乾�e$<p��l�?���IV�jvߚo��i��9CA M��ib+e%��0W�i�{Ξ~�X%E�r�x�����YR�����cF��O��RyE���6^��țPT^%�!���꾼p]���r"�4k�<��v��]���x՟j��@9> �(�����o�Vv��a�ÓA���kL�ޏ����v̇����>��.G���#ȄG��
��p-Í�D�q+%�]����-�"{���{�M�-��^�hm�I�id����	�[��y���Dqh      �      x��\�r�H�}F^fw'B����O��e[�<n��OL�D(P0I@���~��@ )�۫ˎ�)^d�S�y��,�m��M]T��H�g��[�� }�-����v��UU�-*x���3���m��إ�ӫ����sj]k��7�e5w�6��L�کm�6��-��^V�����&y�,�ݲ����_��?e�1�,A��>V��&�m�?C��ry�x���s{S�e�ډ;\�C{�M��vv�D���������ü��<q5\��_���g����gͤ�&�SΕ�3�1��_� �Jƚ�W23%S*Y��V"�c�Xi��`E�7�$A�PI%�H��L
�������?��H�u��'6�XMl�j���*���&}�
u�^~<����O�T 2��e��ڶ_���;�U�?����M/��>>�ݷ�^��VD��/��m�hxT Bٿ���\���>4Z��T�ܿv��Y5�njKا3�#')�\�r�3B���I���D%� �2+$\QdY�QF�9�(!,B���H�6vq+^�\�u�ͤ�'�����~�DN��ꃷU��$���/�/f��R�a��-���w�Un���Qz�) ��35꓃E�LH��"^�i�)r:7����׀	��T0E8O�n��j+��Na�'\����f����V�Uz>K3 ��ǳf��(L=|�t�ԅ�'�	<i�In�]�x�n�?}/=|���}�;ӣ��Q���$��~���+I��gHaK�Z!mq�2�d�#N�~�j��Jm��	xr+�Z�$�&���� L�j����2⹯;�� ����\�#�Rz�y�� ������E���lm=�
B҆ģJǷS�2���������]��l�j����p:N�~!�*wF���B"N�2�8R�Ie����8j���qȡj�D���j1�鱝��ŧ"�ah�$�� �._�ڪ����K�F�&x�,�����S�`�qŶj��&@F�$�̐��У(�X H:KTYb�a)�Zg��"���]A<�>OC��T�",�7F �W���,;�\ۺhCX	�2c�%�V"D_���/(q"�sI��� V
�[��!
�(��U)��,7	Rh�c$�H��7��C��. �"hj�7o�${�1��W��N��fH!(޴��)Ō�Rm̽���De���ǅh_�����d��2T1�� .�F�f%bԊ��
(n"
�9�
lD�w�����Pa�"� �]@k¸��]�.=5w�����f>�^u�
�hb�X���A�)>֢��ݼW��>GDΰ�&�rP
�ID�0QJ ��CY.J�SF��=��=�?J�.l��rx���H�E7)P�N;o�Y����7��W5,�]T^~���Y'7��&�E���jA���#wT�r�f<%�?��!��F�W,cC%g9)������bPiV���� ��6	,����s����[�L�j�~pe��H�#���P+
"y_���Ğ�=	D��y��`H��Uy&"����la9�:L��d��$Dȟ���l�(��� 
�<��:z�{����0����E�Lr9��AP�!+#d��\�r�g���-�����To�A.�	���8:�� m�%^H��d��h��6^r �Q�I���^�Ȇm��x�.�Y���ص��> ��\�0d����`�o�s�U���o���Q� �$Jh� �$l�A����H��p�P����7�4'�DHA@����R�2S �͑��K�BT煶�J�!L��G|S��ٍ�# dڤ1�^ٶ+b�5�h��ꇓ�3�o�9���:��Ѥ���	���H�����6�����I��D<Ɗhy|!����!�	�-(�(SE��His�	+�'Vj��+7��^��f/1^/�m�۪��Ws�1z ��0� �R���V��7u�xd�7���1R
D�e
[�{f�eP� ���)$�)R	�k�A
($0�U�z#�������ǁ��k�
��y0i,�۾p	ВF��!Fx��w��ͫ���4�X+�U�H�`(f��0U'���3��I�/��@Sا}@��-�'�-Z�ؾr]��.�eO
���`ir����_#@?�&��Ҡ�\p����qe���'����l���*s\Q�G�z�DZ3��:h��e���G���=� ���E��Nao�0:q��P�n����*C�y����'�4��du����g�à�!�l��;�s�5�}[eY��,%�*������;�h he��pT���3���=��؈�w��߼�,��~���p�@��T�˶�r~U���1Ѐ��2�b���{�c{��Ě�F�-x#�+�
�D��r��!2%��.4��,,ޠ�0_Y�Jh{l��Q]�^e��̇�����#2=�����f��N��.��dO���t���L�x"�;�(*3��E�5ޜ*����1Р��MQS��L�/1"�{���hݼ�'��z߀*�(<\��l�^��[,!�퀂k&�-����z���^+����M.*Mn+��"��-�\��e�t�7� �+�a�N�{㸃Tx[q.�ˡ��������a���r�e�_���O��X��c@�s�6L!��F��O�����2��\���$�B�b�pT1J� �ʋU|^o���ĕ����8M^9_����n��X�3T@n�q(��G4V���$��Ƅ���J8��B�\;�����Hk�̈́�t��2��$� �����]6��kW�:�<����W��C[-m���0�F�N�Nb�7�V"��p�;}�P⑮3+T.\�
N@�f�o�sĠ��͹��`p4d��$����+�8����b|�̓��o�C
��(}�8k]�96K���7Y�GP�mj�o���ֽˎX��ٹ��s;���4e�=QTPE[n;�a��I���2 |�!��<�"�4s�ҁ��C%1�|����S\V��_��Q?�=�qJ�0'A[��3k�*��f>�F��{(�خ(G	�9x�$�l�x��%f��?�s�Y)0T"��V8w��u��j TH�{���nj�U�뫋t8S�7|���zoXCV-��YM*�9�~�ٗ�ƴ���' 鞠�oO�2��4+2�x"���AFY���-+�+�VA��	��W͝_�����Ѩ���]��� �5�{t=�E�x����M�=�)V����e�dDH���<u^������*aS�� �s���h�@V �%/|6U@7c\3�j�K-YB��E�)��s�	�؛�V�b�ZV�r�����/'/`��qjH���|���'v~�AVN����� �I�!0:b�l
PQ�b5�9G*� ����"ㄵX��k�[�oZI��ǧ����iv��ˏ�?B>��Օ��~��J0������j��d�g΄�N�@)�J�L�kJ<�� ,K�D�ڲ�1�2�Ʉ��zNF���9fqn�j���.�8f��&P�O㷟7�&��~0у���X�4���zzH���G��g΅�B��[�F+�������:�P��(΋<�If���Ϣ@ac{-�����4Y�Wv��xbt�b�Mz�)��w�-�:��wa,~�6�F�
��p��.�,��i/��r�ً���&����S�AE1��Z�<C:��p����"�@jq]��(� r�)R�c�
-@x�=��E��q���U��	b�O2������ޱ��[Mүͤ�(��m�:� �`��;f��e�zy��2h�%���kl\ィ���ָ�Hg��g��p�h�91½��c�a�'lǌ�E�;MߴU�g��k����߻&�-�ãZ�`��%�kX�v�����g4����1�Q�y���.�.���&�3J�I�;н�E��f�c*�f�ң\5%ȕ��9J�6~�/0���K	�q?\6�7[vw
{�հ �/>լ%(=ٽF�]M�M(=�m����[�I�X V	  d0�[�8b��f�T!-�9&3�K�0��@p?��0ń�8=��!��������Uz����9o@4��p&���H�Og��uo�je���q�o�4�q#��פ迭ALhhJY�7)�0<?�BQ�,E�j͋"w�¶�c~#'l�+a��]����f	�F6S&�"7��2ݝ����=���Y?�d(�J� ��Yg*��ezbn��rˆ��	^��H�������	ҜI�(K4-g�N��fe��K؎����D۶ޑ���ض]��!	����Ϊ.�fo/R�q~��d�{��@M��Ο�Y�U�F`AF}�c�ll�o�y��3L�q��+��2�C�e1mA�d�ԃ��$T�����-;�`��ÎC� ;q ���O�m &��q�Ci���It ���N��éuu��:zQ�(��q�z�;:l�OON@%���G��� � ����>@�0IՀ�r~Z�̈�b��Zkf��	�kn���`݊39����W.�C�rhe`����h"t=GIλy��#�� ;�j8h�]�BI�aW�/���r��*��]����^T�j��=.�S���fS�)�2����P�,�k��sB#�i��-�ߛ��a���"R�~��0"���8�8����Ћ�M}"=�����[��>���J}o�k��������.��Q�}jl���q8P�����̈xn�匕
���@"+T2]
a-���� �r5j�o���81b���G�GɰA��ԏ�mY���~�@ ���@�a��GѸ�m$�`V��!�"!��9�r��!n�|�I�2iQ��"=�����uO�K����xV�3?��уU��~�hj�y}�\S�x��{�y6Oj�f+���V��u��{T�Po�	G��T����;+���3��:�mr~��q���Ũ�� �N�{�W}���6��t	��e�p��Сl�n��(#{�����4���'�Q@�Y�����R;d��i)H�3e�Y�kS~�q�f���P��y�Oh�3��kL =m���R���
=|8=�9W];�8���pP3��O�v�ڰ�<e�x�E��'�����,EAK�QnB�t~*�D^LjM*�P������:r�c��<��W�"%8��}Bww^vşT:�c�[���
~y_�S�}������N+��;� g�~�o|0��/�ǔ�Q�"���"�sgY� �癰�8+,�?�c��J6���X�>������^�
��k��CW6���R��S�Uwk�z�l�D`>�B��6��3��k�=�xzJo�j�����P��f�Q�o}a�@C��YY�����N�ѫf���\��fH�ko��;X�i0��׽�%�B�T��kҏa�Z'
��������jz���ݒQO�0��KCdr(��uFo/��.�<�u'�nPO����[�HM?�9~�	���x���蔀�U&��<��T�+
�4�t�h�ўj�.���8�b�OU��O��������y�����"(��T�̊n��/��b����XY�K�?������T�r6>� �ٟq��6-TY��Nb/���0DD^��x����9@) ��9��5�FC���F>֛��cog��H��*	C�ʹ�pFǺ/���a۝�=^t����7U�tma��iW�U
�)��;���(~y\��@��:�[ B��e@�@�[�2Rb��b�XA�������_��#�Ϫi����}&nc��e�h����>^?u����O�m5�[v��!Gwk�l����1��D�>>M��ӷ,J(	�ܰ�i���R��1ɹ �Ф֊
�[2�UQM�Cm��K7T�- ���Q�@�FYCg»�i>|�1�pu}�����s�kZE�6ҟt
K��IĜJ�@<�A9��T�3Ꮡ!���-ʴ��˵�e	���I%Y�����6c#'��ߋdaPDl8��8�L�K��/<��Y<�sT�~}��(���xΪ�wչ����_.��~;���糋����[|j�Y�5R�R�Z�&OK(�
�Q�b���L�}/��O涚�O|�4�~)c�	$ę:yyv$���al^;
��	�)���/ʚ��кl�d�.������WW��%��7����_���'o�������	��������U�2H"�������=��Xy�v ����D��crvvF^¢La���Mnb�I��~����)W6�r�G:I`x�3��E*�͂���֗��ߎ��;����_/���T�vt���6���;[tm��tx������aR�E��a)�/�|���{��V��5#'
�}ztj�_�S|D��K)$b���y��O?�/���      �      x������ � �      �      x������ � �      �   �   x�m��n�@F��S�`���n�j��Z�ƶ7S :���TЧ�41����I�|�hŷ,�>*�>���\�;��QB���R�2�d0�������|6L�+��0�Ec�LC�]zOs7���(Ͻ�����i@Ǆ�ňus�\F1���L�C���μ�9��v�� ���kgN+y,�n��uj��K��`��S��Uݵ\~���C�>B��eRW     