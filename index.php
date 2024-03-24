<?php
session_start();
require_once __DIR__ . "/classes/header.php";
require_once __DIR__ . "/classes/db.php";
?>

<body class="container">
    <div class="row">
        <h1 class="mt-2 d-flex justify-content-center">URL Shortener</h1>
        <?php
        if (isset($_SESSION['error'])) {?>
            <h3 class="text-uppercase text-danger mx-auto text-center"><?= $_SESSION['error'] ?></h3>
        <?php
            unset($_SESSION['error']);
        }
        elseif (isset($_SESSION['success'])) {?>
             <h3 class="text-uppercase text-success mx-auto text-center"><?= $_SESSION['success'] ?></h3>
        <?php
            unset($_SESSION['success']);
        }
        ?>
        <div class="col-8 offset-2">
            <form action="shorten.php" method="POST">
                <div class="col-12 my-3">
                    <label for="url" class="form-label mb-1">Enter URL to shorten:</label>
                    <input type="text" id="url" name="url" class="form-control input-lg mb-2">
                    <button type="submit" class="btn btn-primary">Shorten</button>
                </div>
            </form>
        </div>

        <hr class="border">

        <div class="col-10 offset-1">
            <table class="table table-striped col-12 bg-light border mt-0 overflow-auto">
                <thead>
                    <tr class = "font-weight-light font-10">
                    <th scope="col-1" class="font-12 m-1 p-1">#.</th> 
                    <th scope="col-7" class="font-12 m-1 p-1">Orginal URL</th>
                    <th scope="col-3" class="font-12 m-1 p-1">Short URL</th>
                    <th scope="col-1" class="font-12 m-1 p-1">No.</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sql = "SELECT * FROM urls WHERE 1";
                    $stmt = $conn->prepare($sql);
                    $stmt = $conn->query($sql);
                    $i = 1;
                    $id=null;          
                    while($row = $stmt->fetch())
                    {
                    ?>
                    <tr class="<?=$color?> my-1">
                        <td class="m-1 p-1"><?=$i?></td>
                        <td class="m-1 p-1"><?=$row['original_url']?></td>
                       
                    <?php 
                        $i++;
                        echo "
                        <td class='m-1 p-1'>
                            <a target='_blank' onclick='refreshIndexPage()' href='shorten.php?id={$row['id']}'>http://"?><?=$row['short_code']?> 
                        <?php       
                        echo
                            "</a>
                        </td>"?>
                        <td class="m-1 p-1"><?=$row['access_count']?></td>
                    <?php
                    echo
                    "</tr>";  
                    }
                    ?>  
                </tbody>
            </table>
        </div>
    </div>

    <?php
    require_once __DIR__ . "/classes/footer.php";
    ?>