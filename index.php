<?php
include 'db.php';
$status = "";
$location = "";
$expected = "";

if(isset($_POST['tracking_number'])){
    $tracking_number = $_POST['tracking_number'];
    $sql = "SELECT * FROM packages WHERE tracking_number='$tracking_number'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $package = $result->fetch_assoc();
        $status = $package['status'];
        $location = $package['location'];
        $expected = $package['expected_date'];
    } else {
        $status = "Nincs ilyen csomag!";
    }
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>DropNet</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>

  <!-- Háttér animáció -->
  <div class="background"></div>

  <!-- Fejléc -->
  <header class="header">
    <div class="logo-btn">🚚 DropNet 📦</div>
    <div class="button">
      <a href="kapcsolat.html" class="btn">Elérhetőségeink</a>
      <a href="Információk.html" class="btn">Információk</a>
      <a href="bejelentkezes.php" class="btn">Bejelentkezés</a>
    </div>
  </header>

  <!-- Hero -->
  <section class="hero">
    <div class="hero-text">
      <h1>DropNet: Ahol minden csomag számít</h1>
      <h3>Biztonság, gyorsaság, átláthatóság, mindezt egy helyen.</h3>
      <hr>

      <!-- Csomagkövető űrlap -->
      <form class="tracking-form" method="post" action="index.php">
        <input type="text" name="tracking_number" placeholder="Írd be a csomagszámot..." required />
        <button type="submit">Keresés</button>
      </form>

      <!-- Eredmény kiírás -->
      <?php if($status != ""): ?>
        <div class="tracking-result" style="margin-top:1rem; background:rgba(255,255,255,0.1); padding:0.5rem; border-radius:8px;">
          <p>Státusz: <strong><?php echo $status; ?></strong></p>
          <?php if($location): ?><p>Hely: <?php echo $location; ?></p><?php endif; ?>
          <?php if($expected): ?><p>Várható érkezés: <?php echo $expected; ?></p><?php endif; ?>
        </div>
      <?php endif; ?>
    </div>


  <!-- Szolgáltatások -->
  <section class="features">
    <div class="feature">
      <h3>⚲ Budapest lefedettség</h3>
      <p>Pest megyén belül a lehető leggyorsabb megoldás.</p>
    </div>
    <div class="feature">
      <h3>⏱︎ Villámgyors szállítás</h3>
      <p>Expressz opció 24–48 órán belül.</p>
    </div>
    <div class="feature">
      <h3>✓ Biztos kézbesítés</h3>
      <p>Minden csomag nyomon követhető és sértetlenül ér célba.</p>
    </div>
  </section>

  <!-- Árlista -->
  <section class="arazas">
    <h2>Egyszerű árképzés</h2><hr>
    <div class="cards">
      <div class="card">
        <h4>Alap</h4>
        <hr><p class="price">1 290 Ft</p>
        <p>kis csomag<br> esetén</p>
      </div>
      <div class="card">
        <h4>Standard</h4>
        <hr><p class="price">2 490 Ft</p>
        <p>közepes csomag<br> esetén</p>
      </div>
      <div class="card">
        <h4>Express</h4>
        <hr><p class="price">4 990 Ft</p>
        <p>gyors szállítás<br> esetén</p>
      </div>
    </div>
  </section>

  <!-- Kapcsolat -->
  <section class="contact">
    <h2>Kapcsolat</h2>
    <form>
      <input type="text" placeholder="Név" />
      <input type="email" placeholder="Email" />
      <textarea placeholder="Üzenet"></textarea>
      <button>Küldés</button>
    </form>
  </section>

  <!-- Lábléc -->
  <footer class="footer">
    <p>© 2025 DropNet</p>
    <div>
      <a href="adatvedelem.html">Adatvédelem</a>
      <a href="#">ÁSZF</a>
      <a href="#">Kapcsolat</a>
    </div>
  </footer>

</body>
</html>
