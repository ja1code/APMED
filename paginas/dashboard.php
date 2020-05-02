
<h1 id="type"></h1>
<script>
    let a = localStorage.getItem('type')
    if (a) {
        document.getElementById('type').innerText = "Logado como "+a
    } else {
        window.location.href = window.location.origin + "/paginas/login.php"
    }
</script>