function tomaId(id){
    let eliminar = document.getElementById('eliminar');
    eliminar.setAttribute('href','posts.php?delete='+id);
}