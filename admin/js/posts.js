function savePost()
{
    var postTitle = document.getElementById("postTitle").value;
    var postData = tinymce.activeEditor.getContent();
    var isCommentsAllowed = document.getElementById("commentsForNewPost").checked;

    if(postTitle == "" || postData == "")
    {
        alert("This fields are mandatory! { Title, Content }")
    }
    else
    {
        if(postTitle.length > 300)
        {
            alert("Title is too long to store!")
        }
        else
        {
            currentDateTime = new Date().toDateString()
            $.post("../ajax/admin/posts.php", {type:"ADD",postTitle:postTitle,postData:postData,isCommentsAllowed,currentDateTime} ,function(data,status){
                if(data.STATUS == "SUCCESS")
                {
                    window.location.reload()
                }
                else
                {
                    alert("ERROR : " + data.ERRMSG)
                }


            });
        }
    }

}

function getDateFromISO(dataDate)
{
    newDateDate = new Date(dataDate)
    return newDateDate.getDate() + "-" + newDateDate.getMonth() + "-" + newDateDate.getFullYear();
}