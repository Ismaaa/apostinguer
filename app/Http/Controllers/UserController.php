<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
//use Illuminate\Html\HtmlServiceProvider;

class UserController extends Controller
{
    
    public function getDashboard()
    {
        return view('dashboard', ['user' => Auth::user()]);
    }
    
    public function getSignAdmin()
    {
        return view('signadmin');
    }

    /*-- Pass admin --*/
    public function postAdmin(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'password' => 'required'
        ]);
        
        if (Auth::attempt(['first_name' => $request['first_name'], 'password' => $request['password']])) {
            return redirect()->route('admin');
        }
        return redirect()->back();
    }
    
    public function postSignUp(Request $request)
    {
        $this->validate($request, [
            'first_name'=> 'required|max:20',
            'second_name'=> 'required|max:20',
            'dni' => 'required|max:9',
            'email' => 'required|unique:users|',
            'password' => 'required|min:3'
        ]);
        
        $first_name = $request['first_name'];
        $second_name = $request['second_name'];
        $dni = $request['dni'];
        $email = $request['email'];
        $adress = $request['adress'];
        $phone = $request['phone'];
        $password = bcrypt($request['password']);
        
        $user = new User();
        $user->first_name = $first_name;
        $user->second_name = $second_name;
        $user->dni = $dni;
        $user->email = $email;
        $user->adress = $adress;
        $user->phone = $phone;
        $user->password = $password;
        
        $user->save();
        
        Auth::login($user);
        
        return redirect()->route('dashboard');
    }
    
    public function postSignIn(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return redirect()->route('dashboard');
        }
        return redirect()->back();
    }
    
    /*---------- Vistes admin ---------*/
    
    public function getListNameASC()
    {
        $users = User::get();
        $users = User::orderBy('first_name', 'ASC')->paginate(30);
        return view ('admin')->with('users', $users);
    }
    
    public function getListNameDSC()
    {
        $users = User::get();
        $users = User::orderBy('first_name', 'DSC')->paginate(30);
        return view ('admindsc')->with('users', $users);
    }
    
    public function getListDniASC()
    {
        $users = User::get();
        $users = User::orderBy('dni', 'ASC')->paginate(30);
        return view ('dni')->with('users', $users);
    }
    
    public function getListDniDSC()
    {
        $users = User::get();
        $users = User::orderBy('dni', 'DSC')->paginate(30);
        return view ('dnidsc')->with('users', $users);
    }
    
    public function getListAdrecaASC()
    {
        $users = User::get();
        $users = User::orderBy('adress', 'ASC')->paginate(30);
        return view ('adreca')->with('users', $users);
    }
    
    public function getListAdrecaDSC()
    {
        $users = User::get();
        $users = User::orderBy('adress', 'DSC')->paginate(30);
        return view ('adrecadsc')->with('users', $users);
    }
    
    public function getPdf()
    {
        return view ('pdf');
    }
    
    /*-- accions --*/
    
    public function getUsuari($id)
    {
        $user = User::find($id);
        return view('usuari', ['user' => $user]);
    }
    
    public function editarUsuari($id)
    {
        $user = User::find($id);
        return view('editar', ['user' => $user]);
    }
    
    public function destroyUsuari($id)
    {
        $user = User::find($id);
        User::destroy($id);
        
        return redirect()->route('admin');
    }
    
    /*---------- Fi Vistes admin ---------*/
    
    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
    
    public function getPerfil()
    {
        return view('perfil', ['user' => Auth::user()]);
    }
    
    public function getAccount()
    {
        return view('account', ['user' => Auth::user()]);
    }
    
    public function postSaveAccount(Request $request)
    {
        $this->validate($request, [
            
        ]);
        
        $user = Auth::user();
        
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $filename = $request['first_name'] . '-' . $user->id. '.jpg';
            Storage::disk('local')->put($filename, File::get($file));
        }

        $user->first_name = $request['first_name'];
        $user->second_name = $request['second_name'];
        $user->adress = $request['adress'];
        $user->phone = $request['phone'];
        $user->update();
        
        return redirect()->route('account');
    }
    
    public function getUserImage($filename)
    {
        $file = Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }
    
    public function destroy($id)
    {
        $user = Auth::user();
        User::destroy($id);
        
        return redirect()->route('home');
    }
    
    public function getpdfpreview()
    {
        $user = User::get();
        $user = User::orderBy('second_name', 'ASC')->get();
        
        $pdf = \PDF::loadView('downloadUserASC', ['users' => $user]);
        return $pdf->stream('archivo.pdf');
    }
    
    public function getpdfpreview2()
    {
        $user = User::get();
        $user = User::orderBy('second_name', 'DSC')->get();
        
        $pdf = \PDF::loadView('downloadUserDSC', ['users' => $user]);
        return $pdf->stream('archivo.pdf');
    }
    
    public function getpdfpreviewDni()
    {
        $user = User::get();
        $user = User::orderBy('dni', 'ASC')->get();
        
        $pdf = \PDF::loadView('downloadDniASC', ['users' => $user]);
        return $pdf->stream('archivo.pdf');
    }
    
    public function getpdfpreviewDni2()
    {
        $user = User::get();
        $user = User::orderBy('dni', 'DSC')->get();
        
        $pdf = \PDF::loadView('downloadDniDSC', ['users' => $user]);
        return $pdf->stream('archivo.pdf');
    }
    
    public function getpdfpreviewAdress()
    {
        $user = User::get();
        $user = User::orderBy('adress', 'ASC')->get();
        
        $pdf = \PDF::loadView('downloadAdressASC', ['users' => $user]);
        return $pdf->stream('archivo.pdf');
    }
    
    public function getpdfpreviewAdress2()
    {
        $user = User::get();
        $user = User::orderBy('adress', 'DSC')->get();
        
        $pdf = \PDF::loadView('downloadAdressDSC', ['users' => $user]);
        return $pdf->stream('archivo.pdf');
    }
}