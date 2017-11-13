<h1>Flight # {id}</h1>
<form role="form" action="/flight/submit" method="post">
    {fid}
    {fplane}
    {ffrom}
    {fto}
    {ftakeoff}
    {flanding}
    {zsubmit}
</form>
{error}
<a href="/flight/cancel"><input type="button" value="Cancel the current edit"/></a>
<a href="/flight/delete"><input type="button" value="Delete this flight"/></a>