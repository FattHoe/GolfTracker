function showOrHideAdminProfile()
{
  if (document.getElementById("adminProfileContainer").hidden)
  {
    document.getElementById("adminProfileContainer").removeAttribute("hidden");
  }
  else
  {
    document.getElementById("adminProfileContainer").setAttributeNode(document.createAttribute("hidden"));
  }

  return;
}