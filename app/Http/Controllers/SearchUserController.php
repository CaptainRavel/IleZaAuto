<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SearchUserController extends Controller
{
   public function index()
{
return view('searchuser.search');
}
public function search(Request $request)
{
if($request->ajax())
{
$output="";
$users=DB::table('users')->where('name','LIKE','%'.$request->search."%")->get();
if($users)
{
foreach ($users as $key => $user) {
$output.='<tr>'.
'<td>'.$user->name.'</td>'.
'<td>'.$user->email.'</td>'.
'<td>'.$user->role.'</td>'.

'</tr>';
}
return Response($output);
}
}
}
}