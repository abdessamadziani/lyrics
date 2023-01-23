function showData(id)
{
    console.log("id is"+id)
    document.getElementById("save").style.display="none"
    document.getElementById("update").style.display="none"
    document.getElementById("id").value=document.getElementById("id"+id).getAttribute("data")
    document.getElementById("name").value=document.getElementById("name"+id).getAttribute("data")
    document.getElementById("date").value=document.getElementById("date"+id).getAttribute("data")
    // document.getElementById("img").value=document.getElementById("img"+id).getAttribute("data")


}
document.getElementById("addNewArtist").onclick=function()
{
    document.getElementById("update").style.display="none"
    document.getElementById("save").style.display="block"
    document.getElementById("formArtist").reset()
   


}
document.getElementById("plus").onclick=()=>
{
    let modalbody=document.getElementById("body-modal")
    let newdiv=document.querySelector(".newdiv")
    newdiv.append(modalbody.cloneNode(true))
    
    // modalbody.innerHTML+=`<div class="mb-3">
    // <input type="text" hidden  class="form-control" id="id" name="id" >
    //   <label class="form-label">Name</label>
    //   <input type="text" class="form-control" id="name" name="name"  >
    // </div>
    // <div class="mb-3">
    //   <label  class="form-label">Date</label>
    //   <input type="date" class="form-control" id="date" name="date" >
    // </div>
    // <div class="mb-3">
    //   <label  class="form-label">Image</label>
    //   <input type="file"  class="form-control"  id="file" name="file" >
    // </div>`

    modalbody.append(modalbody)


}
