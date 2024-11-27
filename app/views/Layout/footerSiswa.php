<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
    .footert{
        display: flex;
        justify-content: space-between;
        padding-left: 2rem;
        padding-right: 4rem;
        padding-top: 10px;
        padding-bottom: 10px;
        background-color: #434F65;
    }

    .p-footer{
        font-size: 14px;
        color: white;
    }

    span{
        font-weight: bold;
    }

    @media screen and (max-width: 744px ){
        .p-footer{
            font-size: 8px;
        }
        .footert{
            padding-left: 1rem;
            padding-right: 2rem;
        }
    }
</style>

<body>
    <footer class="footert" >
        <p class="p-footer" >© Copyright BismilahIP4. All Right Reserved</p>
        <p class="p-footer" >Design By <span>Alphacntr</span></p>
    </footer>
</body>
</html>