CREATE TABLE `geoip` (
  `id` int(64) NOT NULL,
  `ip_from` int(11) NOT NULL,
  `ip_to` int(11) NOT NULL,
  `country_code` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `country_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `region_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `city_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


ALTER TABLE `geoip`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `geoip`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT;