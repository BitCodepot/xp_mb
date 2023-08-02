
--
-- Table structure for table `mb_config`
--

DROP TABLE IF EXISTS `mb_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mb_config` (
  `config_id` int(5) NOT NULL AUTO_INCREMENT COMMENT '参数主键',
  `config_name` varchar(100) DEFAULT '' COMMENT '参数名称',
  `config_key` varchar(100) DEFAULT '' COMMENT '参数键名',
  `config_value` varchar(500) DEFAULT '' COMMENT '参数键值',
  `create_by` varchar(64) DEFAULT '' COMMENT '创建者',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_by` varchar(64) DEFAULT '' COMMENT '更新者',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  `remark` varchar(500) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`config_id`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8 COMMENT='参数配置表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mb_config`
--

LOCK TABLES `mb_config` WRITE;
/*!40000 ALTER TABLE `mb_config` DISABLE KEYS */;
INSERT INTO `mb_config` VALUES (1,'网站名称','webname','小票咪表','',NULL,'',NULL,NULL),(100,'管理员账号','admin_name','admin123','',NULL,'',NULL,NULL),(101,'管理员密码','password','admin123','',NULL,'',NULL,NULL),(102,'信息1','info_1','<h2>订单信息</h2>\n    <p>订单号：123456789</p>\n    <p>日期：2023年7月31日</p>\n    <p>客户：John Doe</p>\n','',NULL,'',NULL,NULL),(103,'信息2','info_2','<h2>商店信息</h2>\n    <p>玉米铺子</p>\n    <p>地址：Sen.ge</p>\n    <p>邮箱：79037452@qq.com</p>','',NULL,'',NULL,NULL),(104,'信息3','info_3','<h2>购物提示</h2>\n    <p>1. 请保留好您的小票，作为商品保修和退换货的凭证。</p>\n    <p>2. 如需退换货，请在购买后的7天内前往本店办理，超时恕不受理。</p>\n    <p>3. 商品出售后，请妥善保管好发票和商品，避免损坏影响售后服务。</p>\n    <p>4. 如有任何问题，请及时联系我们的客服，我们将竭诚为您服务。</p>','',NULL,'',NULL,NULL);
/*!40000 ALTER TABLE `mb_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mb_domains`
--

DROP TABLE IF EXISTS `mb_domains`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mb_domains` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `domain_name` varchar(255) NOT NULL COMMENT '域名',
  `price` decimal(10,2) NOT NULL COMMENT '价格',
  `platform` varchar(255) DEFAULT NULL COMMENT '域名所属平台',
  `description` text COMMENT '域名介绍',
  `platform_url` varchar(255) DEFAULT NULL COMMENT '售卖平台URL',
  `status` enum('available','sold','reserved') NOT NULL,
  `comment` varchar(255) DEFAULT NULL COMMENT '备注',
  `order_number` int(11) DEFAULT NULL COMMENT '排序号',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COMMENT='域名列表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mb_domains`
--

LOCK TABLES `mb_domains` WRITE;
/*!40000 ALTER TABLE `mb_domains` DISABLE KEYS */;
INSERT INTO `mb_domains` VALUES (1,'bt.td',999.00,'af','对称米，变态土豆',NULL,'available',NULL,1,'2023-08-01 08:22:20'),(2,'qq.com',888.00,'腾讯云','腾讯qq','','sold',NULL,1,'2023-08-01 22:57:29'),(51,'too.lu',888.00,'趣域','tool，工具','https://www.quyu.net/','available',NULL,0,'2023-08-02 07:38:29'),(52,'sen.ge',0.00,'趣域','森哥','','reserved',NULL,0,'2023-08-02 07:40:43'),(53,'diaosi.cc',300.00,'西数','屌丝','https://www.west.cn/sale/95854086.html','available',NULL,0,'2023-08-02 07:46:37'),(54,'hostel.top',5000.00,'西数','招待所、旅店、青旅','https://www.west.cn/services/paimai/show.asp?pid=94647972','available',NULL,0,'2023-08-02 07:54:03'),(55,'amd.pw',3000.00,'西数','AMD 爱民贷 按摩店 阿曼达','https://www.west.cn/services/paimai/show.asp?pid=94567761','available',NULL,0,'2023-08-02 07:56:46');
/*!40000 ALTER TABLE `mb_domains` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'mibiao'
--

--
-- Dumping routines for database 'mibiao'
--
