<?php

namespace Vinelab\Assistant;

/**
 * @author Charalampos Raftopoulos <harris@vinelab.com>
 */
class DomainDetector
{
    /**
     * Return domain name.
     *
     * @param  string $http
     *
     * @return string
     */
    public function domain($http)
    {
        if (isset(parse_url($http)['host']) === true) {
            // grab domain with ports (if there are any) and pass it into an array, eg. test.api.najem.com
            $domain = explode('.', parse_url($http)['host']);
        } else {
            // grab domain with ports (if there are any) and pass it into an array, eg. localhost
            $domain = explode('.', parse_url($http)['path']);
        }

        // if domain array has one element only
        if (sizeof($domain) === 1) {
            // then that element is the domain's name
            $domain = $domain[sizeof($domain) - 1];
        } else {
            // get the second element from the end of the array (domains might have two levels at most, eg. co.uk)
            $secondLvl = strtoupper($domain[sizeof($domain) - 2]);

            // if the secondLvl exists inside the tld array
            if (array_search($secondLvl, $this->tlds) && (sizeof($domain) > 4)) {
                // get the previous element of the array, which will be our domain's name
                $domain = $domain[sizeof($domain) - 3];
            } else {
                // otherwise, we won't have second level domain and our domain's name will be the second element from the end
                $domain = $domain[sizeof($domain) - 2];
            }
        }

        return $domain;
    }

    /**
     * An array with the official tlds from ICAAN.
     *
     * @var array
     */
    protected $tlds = [
        'AAA',
        'AARP',
        'ABB',
        'ABBOTT',
        'ABOGADO',
        'AC',
        'ACADEMY',
        'ACCENTURE',
        'ACCOUNTANT',
        'ACCOUNTANTS',
        'ACO',
        'ACTIVE',
        'ACTOR',
        'AD',
        'ADS',
        'ADULT',
        'AE',
        'AEG',
        'AERO',
        'AF',
        'AFL',
        'AG',
        'AGENCY',
        'AI',
        'AIG',
        'AIRFORCE',
        'AIRTEL',
        'AL',
        'ALLFINANZ',
        'ALSACE',
        'AM',
        'AMICA',
        'AMSTERDAM',
        'ANDROID',
        'AO',
        'APARTMENTS',
        'APP',
        'APPLE',
        'AQ',
        'AQUARELLE',
        'AR',
        'ARAMCO',
        'ARCHI',
        'ARMY',
        'ARPA',
        'ARTE',
        'AS',
        'ASIA',
        'ASSOCIATES',
        'AT',
        'ATTORNEY',
        'AU',
        'AUCTION',
        'AUDIO',
        'AUTO',
        'AUTOS',
        'AW',
        'AX',
        'AXA',
        'AZ',
        'AZURE',
        'BA',
        'BAND',
        'BANK',
        'BAR',
        'BARCELONA',
        'BARCLAYCARD',
        'BARCLAYS',
        'BARGAINS',
        'BAUHAUS',
        'BAYERN',
        'BB',
        'BBC',
        'BBVA',
        'BCN',
        'BD',
        'BE',
        'BEATS',
        'BEER',
        'BENTLEY',
        'BERLIN',
        'BEST',
        'BET',
        'BF',
        'BG',
        'BH',
        'BHARTI',
        'BI',
        'BIBLE',
        'BID',
        'BIKE',
        'BING',
        'BINGO',
        'BIO',
        'BIZ',
        'BJ',
        'BLACK',
        'BLACKFRIDAY',
        'BLOOMBERG',
        'BLUE',
        'BM',
        'BMS',
        'BMW',
        'BN',
        'BNL',
        'BNPPARIBAS',
        'BO',
        'BOATS',
        'BOM',
        'BOND',
        'BOO',
        'BOOTS',
        'BOUTIQUE',
        'BR',
        'BRADESCO',
        'BRIDGESTONE',
        'BROADWAY',
        'BROKER',
        'BROTHER',
        'BRUSSELS',
        'BS',
        'BT',
        'BUDAPEST',
        'BUILD',
        'BUILDERS',
        'BUSINESS',
        'BUZZ',
        'BV',
        'BW',
        'BY',
        'BZ',
        'BZH',
        'CA',
        'CAB',
        'CAFE',
        'CAL',
        'CAMERA',
        'CAMP',
        'CANCERRESEARCH',
        'CANON',
        'CAPETOWN',
        'CAPITAL',
        'CAR',
        'CARAVAN',
        'CARDS',
        'CARE',
        'CAREER',
        'CAREERS',
        'CARS',
        'CARTIER',
        'CASA',
        'CASH',
        'CASINO',
        'CAT',
        'CATERING',
        'CBA',
        'CBN',
        'CC',
        'CD',
        'CEB',
        'CENTER',
        'CEO',
        'CERN',
        'CF',
        'CFA',
        'CFD',
        'CG',
        'CH',
        'CHANEL',
        'CHANNEL',
        'CHAT',
        'CHEAP',
        'CHLOE',
        'CHRISTMAS',
        'CHROME',
        'CHURCH',
        'CI',
        'CIPRIANI',
        'CISCO',
        'CITIC',
        'CITY',
        'CITYEATS',
        'CK',
        'CL',
        'CLAIMS',
        'CLEANING',
        'CLICK',
        'CLINIC',
        'CLOTHING',
        'CLOUD',
        'CLUB',
        'CLUBMED',
        'CM',
        'CN',
        'CO',
        'COACH',
        'CODES',
        'COFFEE',
        'COLLEGE',
        'COLOGNE',
        'COM',
        'COMMBANK',
        'COMMUNITY',
        'COMPANY',
        'COMPUTER',
        'COMSEC',
        'CONDOS',
        'CONSTRUCTION',
        'CONSULTING',
        'CONTRACTORS',
        'COOKING',
        'COOL',
        'COOP',
        'CORSICA',
        'COUNTRY',
        'COUPONS',
        'COURSES',
        'CR',
        'CREDIT',
        'CREDITCARD',
        'CREDITUNION',
        'CRICKET',
        'CROWN',
        'CRS',
        'CRUISES',
        'CSC',
        'CU',
        'CUISINELLA',
        'CV',
        'CW',
        'CX',
        'CY',
        'CYMRU',
        'CYOU',
        'CZ',
        'DABUR',
        'DAD',
        'DANCE',
        'DATE',
        'DATING',
        'DATSUN',
        'DAY',
        'DCLK',
        'DE',
        'DEALS',
        'DEGREE',
        'DELIVERY',
        'DELL',
        'DELTA',
        'DEMOCRAT',
        'DENTAL',
        'DENTIST',
        'DESI',
        'DESIGN',
        'DEV',
        'DIAMONDS',
        'DIET',
        'DIGITAL',
        'DIRECT',
        'DIRECTORY',
        'DISCOUNT',
        'DJ',
        'DK',
        'DM',
        'DNP',
        'DO',
        'DOCS',
        'DOG',
        'DOHA',
        'DOMAINS',
        'DOOSAN',
        'DOWNLOAD',
        'DRIVE',
        'DURBAN',
        'DVAG',
        'DZ',
        'EARTH',
        'EAT',
        'EC',
        'EDU',
        'EDUCATION',
        'EE',
        'EG',
        'EMAIL',
        'EMERCK',
        'ENERGY',
        'ENGINEER',
        'ENGINEERING',
        'ENTERPRISES',
        'EPSON',
        'EQUIPMENT',
        'ER',
        'ERNI',
        'ES',
        'ESQ',
        'ESTATE',
        'ET',
        'EU',
        'EUROVISION',
        'EUS',
        'EVENTS',
        'EVERBANK',
        'EXCHANGE',
        'EXPERT',
        'EXPOSED',
        'EXPRESS',
        'FAGE',
        'FAIL',
        'FAIRWINDS',
        'FAITH',
        'FAMILY',
        'FAN',
        'FANS',
        'FARM',
        'FASHION',
        'FEEDBACK',
        'FERRERO',
        'FI',
        'FILM',
        'FINAL',
        'FINANCE',
        'FINANCIAL',
        'FIRMDALE',
        'FISH',
        'FISHING',
        'FIT',
        'FITNESS',
        'FJ',
        'FK',
        'FLIGHTS',
        'FLORIST',
        'FLOWERS',
        'FLSMIDTH',
        'FLY',
        'FM',
        'FO',
        'FOO',
        'FOOTBALL',
        'FOREX',
        'FORSALE',
        'FORUM',
        'FOUNDATION',
        'FR',
        'FRL',
        'FROGANS',
        'FUND',
        'FURNITURE',
        'FUTBOL',
        'FYI',
        'GA',
        'GAL',
        'GALLERY',
        'GAME',
        'GARDEN',
        'GB',
        'GBIZ',
        'GD',
        'GDN',
        'GE',
        'GEA',
        'GENT',
        'GENTING',
        'GF',
        'GG',
        'GGEE',
        'GH',
        'GI',
        'GIFT',
        'GIFTS',
        'GIVES',
        'GIVING',
        'GL',
        'GLASS',
        'GLE',
        'GLOBAL',
        'GLOBO',
        'GM',
        'GMAIL',
        'GMO',
        'GMX',
        'GN',
        'GOLD',
        'GOLDPOINT',
        'GOLF',
        'GOO',
        'GOOG',
        'GOOGLE',
        'GOP',
        'GOV',
        'GP',
        'GQ',
        'GR',
        'GRAINGER',
        'GRAPHICS',
        'GRATIS',
        'GREEN',
        'GRIPE',
        'GROUP',
        'GS',
        'GT',
        'GU',
        'GUCCI',
        'GUGE',
        'GUIDE',
        'GUITARS',
        'GURU',
        'GW',
        'GY',
        'HAMBURG',
        'HANGOUT',
        'HAUS',
        'HEALTHCARE',
        'HELP',
        'HERE',
        'HERMES',
        'HIPHOP',
        'HITACHI',
        'HIV',
        'HK',
        'HM',
        'HN',
        'HOCKEY',
        'HOLDINGS',
        'HOLIDAY',
        'HOMEDEPOT',
        'HOMES',
        'HONDA',
        'HORSE',
        'HOST',
        'HOSTING',
        'HOTELES',
        'HOTMAIL',
        'HOUSE',
        'HOW',
        'HR',
        'HSBC',
        'HT',
        'HU',
        'HYUNDAI',
        'IBM',
        'ICBC',
        'ICE',
        'ICU',
        'ID',
        'IE',
        'IFM',
        'IINET',
        'IL',
        'IM',
        'IMMO',
        'IMMOBILIEN',
        'IN',
        'INDUSTRIES',
        'INFINITI',
        'INFO',
        'ING',
        'INK',
        'INSTITUTE',
        'INSURE',
        'INT',
        'INTERNATIONAL',
        'INVESTMENTS',
        'IO',
        'IPIRANGA',
        'IQ',
        'IR',
        'IRISH',
        'IS',
        'IST',
        'ISTANBUL',
        'IT',
        'ITAU',
        'IWC',
        'JAGUAR',
        'JAVA',
        'JCB',
        'JE',
        'JETZT',
        'JEWELRY',
        'JLC',
        'JLL',
        'JM',
        'JO',
        'JOBS',
        'JOBURG',
        'JP',
        'JPRS',
        'JUEGOS',
        'KAUFEN',
        'KDDI',
        'KE',
        'KG',
        'KH',
        'KI',
        'KIA',
        'KIM',
        'KINDER',
        'KITCHEN',
        'KIWI',
        'KM',
        'KN',
        'KOELN',
        'KOMATSU',
        'KP',
        'KR',
        'KRD',
        'KRED',
        'KW',
        'KY',
        'KYOTO',
        'KZ',
        'LA',
        'LACAIXA',
        'LANCASTER',
        'LAND',
        'LANDROVER',
        'LASALLE',
        'LAT',
        'LATROBE',
        'LAW',
        'LAWYER',
        'LB',
        'LC',
        'LDS',
        'LEASE',
        'LECLERC',
        'LEGAL',
        'LEXUS',
        'LGBT',
        'LI',
        'LIAISON',
        'LIDL',
        'LIFE',
        'LIFESTYLE',
        'LIGHTING',
        'LIMITED',
        'LIMO',
        'LINDE',
        'LINK',
        'LIVE',
        'LIXIL',
        'LK',
        'LOAN',
        'LOANS',
        'LOL',
        'LONDON',
        'LOTTE',
        'LOTTO',
        'LOVE',
        'LR',
        'LS',
        'LT',
        'LTD',
        'LTDA',
        'LU',
        'LUPIN',
        'LUXE',
        'LUXURY',
        'LV',
        'LY',
        'MA',
        'MADRID',
        'MAIF',
        'MAISON',
        'MAN',
        'MANAGEMENT',
        'MANGO',
        'MARKET',
        'MARKETING',
        'MARKETS',
        'MARRIOTT',
        'MBA',
        'MC',
        'MD',
        'ME',
        'MEDIA',
        'MEET',
        'MELBOURNE',
        'MEME',
        'MEMORIAL',
        'MEN',
        'MENU',
        'MEO',
        'MG',
        'MH',
        'MIAMI',
        'MICROSOFT',
        'MIL',
        'MINI',
        'MK',
        'ML',
        'MM',
        'MMA',
        'MN',
        'MO',
        'MOBI',
        'MODA',
        'MOE',
        'MOI',
        'MOM',
        'MONASH',
        'MONEY',
        'MONTBLANC',
        'MORMON',
        'MORTGAGE',
        'MOSCOW',
        'MOTORCYCLES',
        'MOV',
        'MOVIE',
        'MOVISTAR',
        'MP',
        'MQ',
        'MR',
        'MS',
        'MT',
        'MTN',
        'MTPC',
        'MTR',
        'MU',
        'MUSEUM',
        'MUTUELLE',
        'MV',
        'MW',
        'MX',
        'MY',
        'MZ',
        'NA',
        'NADEX',
        'NAGOYA',
        'NAME',
        'NAVY',
        'NC',
        'NE',
        'NEC',
        'NET',
        'NETBANK',
        'NETWORK',
        'NEUSTAR',
        'NEW',
        'NEWS',
        'NEXUS',
        'NF',
        'NG',
        'NGO',
        'NHK',
        'NI',
        'NICO',
        'NINJA',
        'NISSAN',
        'NL',
        'NO',
        'NOKIA',
        'NP',
        'NR',
        'NRA',
        'NRW',
        'NTT',
        'NU',
        'NYC',
        'NZ',
        'OBI',
        'OFFICE',
        'OKINAWA',
        'OM',
        'OMEGA',
        'ONE',
        'ONG',
        'ONL',
        'ONLINE',
        'OOO',
        'ORACLE',
        'ORANGE',
        'ORG',
        'ORGANIC',
        'OSAKA',
        'OTSUKA',
        'OVH',
        'PA',
        'PAGE',
        'PANERAI',
        'PARIS',
        'PARTNERS',
        'PARTS',
        'PARTY',
        'PE',
        'PET',
        'PF',
        'PG',
        'PH',
        'PHARMACY',
        'PHILIPS',
        'PHOTO',
        'PHOTOGRAPHY',
        'PHOTOS',
        'PHYSIO',
        'PIAGET',
        'PICS',
        'PICTET',
        'PICTURES',
        'PING',
        'PINK',
        'PIZZA',
        'PK',
        'PL',
        'PLACE',
        'PLAY',
        'PLAYSTATION',
        'PLUMBING',
        'PLUS',
        'PM',
        'PN',
        'POHL',
        'POKER',
        'PORN',
        'POST',
        'PR',
        'PRAXI',
        'PRESS',
        'PRO',
        'PROD',
        'PRODUCTIONS',
        'PROF',
        'PROPERTIES',
        'PROPERTY',
        'PROTECTION',
        'PS',
        'PT',
        'PUB',
        'PW',
        'PY',
        'QA',
        'QPON',
        'QUEBEC',
        'RACING',
        'RE',
        'REALTOR',
        'REALTY',
        'RECIPES',
        'RED',
        'REDSTONE',
        'REHAB',
        'REISE',
        'REISEN',
        'REIT',
        'REN',
        'RENT',
        'RENTALS',
        'REPAIR',
        'REPORT',
        'REPUBLICAN',
        'REST',
        'RESTAURANT',
        'REVIEW',
        'REVIEWS',
        'RICH',
        'RICOH',
        'RIO',
        'RIP',
        'RO',
        'ROCHER',
        'ROCKS',
        'RODEO',
        'RS',
        'RSVP',
        'RU',
        'RUHR',
        'RUN',
        'RW',
        'RWE',
        'RYUKYU',
        'SA',
        'SAARLAND',
        'SAKURA',
        'SALE',
        'SAMSUNG',
        'SANDVIK',
        'SANDVIKCOROMANT',
        'SANOFI',
        'SAP',
        'SAPO',
        'SARL',
        'SAXO',
        'SB',
        'SBS',
        'SC',
        'SCA',
        'SCB',
        'SCHMIDT',
        'SCHOLARSHIPS',
        'SCHOOL',
        'SCHULE',
        'SCHWARZ',
        'SCIENCE',
        'SCOR',
        'SCOT',
        'SD',
        'SE',
        'SEAT',
        'SECURITY',
        'SEEK',
        'SENER',
        'SERVICES',
        'SEVEN',
        'SEW',
        'SEX',
        'SEXY',
        'SG',
        'SH',
        'SHIKSHA',
        'SHOES',
        'SHOW',
        'SHRIRAM',
        'SI',
        'SINGLES',
        'SITE',
        'SJ',
        'SK',
        'SKI',
        'SKY',
        'SKYPE',
        'SL',
        'SM',
        'SN',
        'SNCF',
        'SO',
        'SOCCER',
        'SOCIAL',
        'SOFTWARE',
        'SOHU',
        'SOLAR',
        'SOLUTIONS',
        'SONY',
        'SOY',
        'SPACE',
        'SPIEGEL',
        'SPREADBETTING',
        'SR',
        'SRL',
        'ST',
        'STADA',
        'STARHUB',
        'STATOIL',
        'STC',
        'STCGROUP',
        'STOCKHOLM',
        'STUDIO',
        'STUDY',
        'STYLE',
        'SU',
        'SUCKS',
        'SUPPLIES',
        'SUPPLY',
        'SUPPORT',
        'SURF',
        'SURGERY',
        'SUZUKI',
        'SV',
        'SWATCH',
        'SWISS',
        'SX',
        'SY',
        'SYDNEY',
        'SYSTEMS',
        'SZ',
        'TAB',
        'TAIPEI',
        'TATAMOTORS',
        'TATAR',
        'TATTOO',
        'TAX',
        'TAXI',
        'TC',
        'TD',
        'TEAM',
        'TECH',
        'TECHNOLOGY',
        'TEL',
        'TELEFONICA',
        'TEMASEK',
        'TENNIS',
        'TF',
        'TG',
        'TH',
        'THD',
        'THEATER',
        'THEATRE',
        'TICKETS',
        'TIENDA',
        'TIPS',
        'TIRES',
        'TIROL',
        'TJ',
        'TK',
        'TL',
        'TM',
        'TN',
        'TO',
        'TODAY',
        'TOKYO',
        'TOOLS',
        'TOP',
        'TORAY',
        'TOSHIBA',
        'TOURS',
        'TOWN',
        'TOYOTA',
        'TOYS',
        'TR',
        'TRADE',
        'TRADING',
        'TRAINING',
        'TRAVEL',
        'TRUST',
        'TT',
        'TUI',
        'TV',
        'TW',
        'TZ',
        'UA',
        'UBS',
        'UG',
        'UK',
        'UNIVERSITY',
        'UNO',
        'UOL',
        'US',
        'UY',
        'UZ',
        'VA',
        'VACATIONS',
        'VANA',
        'VC',
        'VE',
        'VEGAS',
        'VENTURES',
        'VERSICHERUNG',
        'VET',
        'VG',
        'VI',
        'VIAJES',
        'VIDEO',
        'VILLAS',
        'VIN',
        'VIRGIN',
        'VISION',
        'VISTA',
        'VISTAPRINT',
        'VIVA',
        'VLAANDEREN',
        'VN',
        'VODKA',
        'VOTE',
        'VOTING',
        'VOTO',
        'VOYAGE',
        'VU',
        'WALES',
        'WALTER',
        'WANG',
        'WATCH',
        'WEBCAM',
        'WEBSITE',
        'WED',
        'WEDDING',
        'WEIR',
        'WF',
        'WHOSWHO',
        'WIEN',
        'WIKI',
        'WILLIAMHILL',
        'WIN',
        'WINDOWS',
        'WINE',
        'WME',
        'WORK',
        'WORKS',
        'WORLD',
        'WS',
        'WTC',
        'WTF',
        'XBOX',
        'XEROX',
        'XIN',
        'XN--11B4C3D',
        'XN--1QQW23A',
        'XN--30RR7Y',
        'XN--3BST00M',
        'XN--3DS443G',
        'XN--3E0B707E',
        'XN--3PXU8K',
        'XN--42C2D9A',
        'XN--45BRJ9C',
        'XN--45Q11C',
        'XN--4GBRIM',
        'XN--55QW42G',
        'XN--55QX5D',
        'XN--6FRZ82G',
        'XN--6QQ986B3XL',
        'XN--80ADXHKS',
        'XN--80AO21A',
        'XN--80ASEHDB',
        'XN--80ASWG',
        'XN--90A3AC',
        'XN--90AIS',
        'XN--9DBQ2A',
        'XN--9ET52U',
        'XN--B4W605FERD',
        'XN--C1AVG',
        'XN--C2BR7G',
        'XN--CG4BKI',
        'XN--CLCHC0EA0B2G2A9GCD',
        'XN--CZR694B',
        'XN--CZRS0T',
        'XN--CZRU2D',
        'XN--D1ACJ3B',
        'XN--D1ALF',
        'XN--EFVY88H',
        'XN--ESTV75G',
        'XN--FHBEI',
        'XN--FIQ228C5HS',
        'XN--FIQ64B',
        'XN--FIQS8S',
        'XN--FIQZ9S',
        'XN--FJQ720A',
        'XN--FLW351E',
        'XN--FPCRJ9C3D',
        'XN--FZC2C9E2C',
        'XN--GECRJ9C',
        'XN--H2BRJ9C',
        'XN--HXT814E',
        'XN--I1B6B1A6A2E',
        'XN--IMR513N',
        'XN--IO0A7I',
        'XN--J1AEF',
        'XN--J1AMH',
        'XN--J6W193G',
        'XN--KCRX77D1X4A',
        'XN--KPRW13D',
        'XN--KPRY57D',
        'XN--KPUT3I',
        'XN--L1ACC',
        'XN--LGBBAT1AD8J',
        'XN--MGB9AWBF',
        'XN--MGBA3A3EJT',
        'XN--MGBA3A4F16A',
        'XN--MGBAAM7A8H',
        'XN--MGBAB2BD',
        'XN--MGBAYH7GPA',
        'XN--MGBBH1A71E',
        'XN--MGBC0A9AZCG',
        'XN--MGBERP4A5D4AR',
        'XN--MGBPL2FH',
        'XN--MGBTX2B',
        'XN--MGBX4CD0AB',
        'XN--MK1BU44C',
        'XN--MXTQ1M',
        'XN--NGBC5AZD',
        'XN--NODE',
        'XN--NQV7F',
        'XN--NQV7FS00EMA',
        'XN--NYQY26A',
        'XN--O3CW4H',
        'XN--OGBPF8FL',
        'XN--P1ACF',
        'XN--P1AI',
        'XN--PGBS0DH',
        'XN--PSSY2U',
        'XN--Q9JYB4C',
        'XN--QCKA1PMC',
        'XN--QXAM',
        'XN--RHQV96G',
        'XN--S9BRJ9C',
        'XN--SES554G',
        'XN--T60B56A',
        'XN--TCKWE',
        'XN--UNUP4Y',
        'XN--VERMGENSBERATER-CTB',
        'XN--VERMGENSBERATUNG-PWB',
        'XN--VHQUV',
        'XN--VUQ861B',
        'XN--WGBH1C',
        'XN--WGBL6A',
        'XN--XHQ521B',
        'XN--XKC2AL3HYE2A',
        'XN--XKC2DL3A5EE0H',
        'XN--Y9A3AQ',
        'XN--YFRO4I67O',
        'XN--YGBI2AMMX',
        'XN--ZFR164B',
        'XPERIA',
        'XXX',
        'XYZ',
        'YACHTS',
        'YAMAXUN',
        'YANDEX',
        'YE',
        'YODOBASHI',
        'YOGA',
        'YOKOHAMA',
        'YOUTUBE',
        'YT',
        'ZA',
        'ZARA',
        'ZIP',
        'ZM',
        'ZONE',
        'ZUERICH',
        'ZW',
    ];
}
