namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login', ['title' => 'Login']);
    }

    public function process(Request $request)
    {
        // nanti kita isi saat backend
        return redirect('/dashboard');
    }
}
