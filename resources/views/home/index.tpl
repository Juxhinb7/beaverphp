<html>

    <div class="container">
            
            <div style="display:flex; flex-direction: row; justify-content: space-between; column-gap: 70px;">
                <div>{html_image file="beaver.png" width="170" height="165"}</div>
               <div>{html_image file="smartyLogo.png" width="170" height="165"}</div>
            </div>
            <h1 style="padding-top: 3vh;">{$webFramework} + {$templateEngine}</h1>


    </div>
    



   
</html>

<style>
    {literal}
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            position: relative;
            top: 50;
            padding: 30vh;
            font-family:'Courier New', Courier, monospace;
        }


    {{/literal}}
</style>