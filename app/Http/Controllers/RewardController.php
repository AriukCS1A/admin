namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reward;

class RewardController extends Controller
{
    public function uploadRewardImage(Request $request)
    {
        $request->validate([
            'productPhoto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => required|string|max:255',
            'info' => required|string|max:255',
            'requiredAge' => required|string|max:255',

        ]);

        $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
        
        
        $filePath = $request->file('image')->storeAs('public/reward', $fileName);

        $reward = new Reward();
        $reward->productPhoto = url('storage/banner/' . $fileName); 
        $reward->name = $request->name;
        $reward->info = $request->info;
        $reward->requiredAge = $request->requiredAge;
        $reward->save();

        return redirect()->back()->with('success', 'Зургийг амжилттай орууллаа');
    }
}
