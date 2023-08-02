<?php
require_once("admin/functions.php");

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title><?=$webname?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="./static/style.css" media="all" />
    <link rel="icon" href="./static/favicon.ico" type="image/x-icon" />




</head>
<body>
<div class="invoice">
  <div class="header">
      <img src="static/logo.png" style="height: 100px">
<!--    <svg height="104" viewBox="0 0 14 34" width="44" xmlns="http://www.w3.org/2000/svg"><path d="m13.0729 17.6825a3.61 3.61 0 0 0 -1.7248 3.0365 3.5132 3.5132 0 0 0 2.1379 3.2223 8.394 8.394 0 0 1 -1.0948 2.2618c-.6816.9812-1.3943 1.9623-2.4787 1.9623s-1.3633-.63-2.613-.63c-1.2187 0-1.6525.6507-2.644.6507s-1.6834-.9089-2.4787-2.0243a9.7842 9.7842 0 0 1 -1.6628-5.2776c0-3.0984 2.014-4.7405 3.9969-4.7405 1.0535 0 1.9314.6919 2.5924.6919.63 0 1.6112-.7333 2.8092-.7333a3.7579 3.7579 0 0 1 3.1604 1.5802zm-3.7284-2.8918a3.5615 3.5615 0 0 0 .8469-2.22 1.5353 1.5353 0 0 0 -.031-.32 3.5686 3.5686 0 0 0 -2.3445 1.2084 3.4629 3.4629 0 0 0 -.8779 2.1585 1.419 1.419 0 0 0 .031.2892 1.19 1.19 0 0 0 .2169.0207 3.0935 3.0935 0 0 0 2.1586-1.1368z"></path></svg>-->
    <h1><?=$webname?></h1>
  </div>
  <div class="content">
      <div class="order-info">
          <?=$info_1?>
      </div>

      <div class="store-info">
          <?=$info_2?>
      </div>

      <?php if (!empty($available_domains)): ?>
          <h2>待售列表</h2>
          <table>
              <tr>
                  <th>域名</th>
                  <th>备注</th>
                  <th>平台</th>
                  <th>价格</th>
              </tr>
              <?php foreach ($available_domains as $domain): ?>
                  <tr class="item">
                      <td><?php echo $domain['domain_name']; ?></td>
                      <td><?php echo $domain['description']; ?></td>
                      <td><?php echo $domain['platform']; ?></td>

                      <td> <a href="<?php echo $domain['platform_url']; ?>">￥<?php echo $domain['price']; ?></a></td>

                  </tr>
              <?php endforeach; ?>
              <tr>
                  <th colspan="4"></th>
              </tr>
              <tr class="item">
                  <td colspan="3" style="text-align: right;"><strong>总价：</strong></td>
                  <td><strong>￥<?=$available_domains_total_price?></strong></td>
              </tr>
          </table>
      <?php endif; ?>

      <?php if (!empty($sold_domains)): ?>
          <h2>已售域名</h2>
          <table>
              <tr>
                  <th>域名</th>
                  <th>备注</th>
                  <th>平台</th>
                  <th>价格</th>
              </tr>
              <?php foreach ($sold_domains as $domain): ?>
                  <tr class="item">
                      <td><?php echo $domain['domain_name']; ?></td>
                      <td><?php echo $domain['description']; ?></td>
                      <td><?php echo $domain['platform']; ?></td>
                      <td>￥<?php echo $domain['price']; ?></td>
                  </tr>
              <?php endforeach; ?>
              <tr>
                  <th colspan="4"></th>
              </tr>
              <tr class="item">
                  <td colspan="3" style="text-align: right;"><strong>总价：</strong></td>
                  <td><strong>￥<?=$sold_domains_total_price?></strong></td>
              </tr>
          </table>
      <?php endif; ?>

      <?php if (!empty($reserved_domains)): ?>
          <h2>保留域名</h2>
          <table>
              <tr>
                  <th>域名</th>
                  <th>备注</th>
                  <th>平台</th>
                  <th>价格</th>
              </tr>
              <?php foreach ($reserved_domains as $domain): ?>
                  <tr class="item">
                      <td><?php echo $domain['domain_name']; ?></td>
                      <td><?php echo $domain['description']; ?></td>
                      <td><?php echo $domain['platform']; ?></td>
                      <td>￥<?php echo $domain['price']; ?></td>
                  </tr>
              <?php endforeach; ?>
              <tr>
                  <th colspan="4"></th>
              </tr>
              <tr class="item">
                  <td colspan="3" style="text-align: right;"><strong>总价：</strong></td>
                  <td><strong>￥<?=$reserved_domains_total_price?></strong></td>
              </tr>
          </table>
      <?php endif; ?>



      <div class="shopping-tips">
      <?=$info_3?>
  </div>
  <div id="qrcode-box">

  </div>
<div class="clear"></div>
</div>


<script src="/static/js/qrcode.min.js"></script>
<script>
  // Function to generate and append QR code to the page
  function generateQRCode() {
    const currentURL = window.location.href;
    const qrCodeContainer = document.createElement('div');
    qrCodeContainer.setAttribute('id', 'qrcode');

    const qrCode = new QRCode(qrCodeContainer, {
      text: currentURL,
      width: 128,
      height: 128,
    });

    const invoice = document.querySelector('#qrcode-box');
    invoice.appendChild(qrCodeContainer);
    qrCodeContainer.style.float = 'right';

  }

  // Generate QR code when the page has fully loaded
  window.onload = generateQRCode;
</script>


</body>
</html>
