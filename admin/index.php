<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Client</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
</head>
<style>
    xmp {
        margin: 0;
        white-space: initial;
        background: #eee;
        padding: 10px;
    }
</style>
<body>
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-6">
                <form action="create.php" method="POST">
        
                    <div class="mb-3">
                        <label class="form-label"  for="client">Client Id</label>
                        <input id="client" class="form-control" name="client_id" type="text">
                    </div>
        
                    <div class="mb-3">
                        <label class="form-label" for="token">Token</label>
                        <div class="input-group">
                            <input id="token" class="form-control" name="token" type="text">
                            <button id="generateToken" class="btn btn-primary">Générer le token</button>
                        </div>
                    </div>
        
                    <div class="mb-3">
                        <label class="form-label" for="html">Code Html & CSS</label>
                        <textarea class="form-control" name="html" id="html" cols="60" rows="20"></textarea>
                    </div>
        
                    <div class="mb-3 d-flex justify-content-between">
                        <input type="submit" class="btn btn-primary" value="Générer le fichier">
                        <input id="iframe-code" type="button" class="btn btn-primary" value="Générer le code iframe">
                    </div>
                </form>
            </div>
            <div class="col-6">           
                <div class="container">
                    <h3>Preview</h3>
                    <iframe width="100%" height="500px" id="iframe-preview" frameborder="0"></iframe>
                </div>

                <h3>Code d'intégration</h3>
                <xmp id="code"></xmp>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <script>

        (function() {
            const html = document.querySelector('#html')
            const preview = document.querySelector('#iframe-preview')

            // Preview du formulaire final
            html.addEventListener('change', () => {
                preview.contentWindow.document.querySelector('body').innerHTML = html.value
            })

            // Prise en compte des tabulations dans les textareas
            let textareas = document.getElementsByTagName('textarea');
            let count = textareas.length;

            for(let i=0;i<count;i++){
                textareas[i].onkeydown = function(e){
                    if(e.keyCode == 9 || e.which == 9){
                        e.preventDefault();
                        let s = this.selectionStart;
                        this.value = this.value.substring(0, this.selectionStart) + "\t" + this.value.substring(this.selectionEnd);
                        this.selectionEnd = s + 1; 
                    }
                }
            }

            // Génération du token
            const buttonGenerate = document.querySelector('#generateToken')
            let client = document.querySelector('#client')
            buttonGenerate.addEventListener('click', (e) => {
                e.preventDefault()
                let tokenEl = document.querySelector('#token')
                let token = generate_token(36)
                tokenEl.value = token
            })

            const buttonIframeGenerate = document.querySelector('#iframe-code')
            const code = document.querySelector('#code')
            buttonIframeGenerate.addEventListener('click', (e) => {
                e.preventDefault()
                let date = new Date()
                let urlFrame = window.location.href + '/' + client.value + '/' + client.value + '_' + date.getDate() + '_' + date.getMonth() + '_' + date.getFullYear() + '.php'
                code.innerHTML = `
                    <iframe src="${urlFrame}" width="100%" height="100%" id="iframe-preview" frameborder="0"></iframe>
                `
            })

        }())


        function generate_token(length)
        {
            let a = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'.split('')
            let b = []
            let c = []

            for (let i = 0; i < length; i++)
            {
                let j = (Math.random() * (a.length - 1)).toFixed(0)
                let k = (Math.random() * (a.length - 1)).toFixed(0)
                b[i] = a[j] + a[k]
            }

            return b.join('')
        }

    </script>
</body>
</html>