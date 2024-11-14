namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class ProductsController extends Controller
{
    public function uploadProductImage(Request $request)
    {
        $request->validate([
            'pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'barCode' => 'required|string|max:255',
            'name' => 'required|string|max:255',
        ]);

        $fileName = time() . '_' . $request->file('pic')->getClientOriginalName();
        
        $filePath = $request->file('pic')->storeAs('public/products', $fileName);

        $product = new Products();
        $product->pic = url('storage/products/' . $fileName);
        $product->barCode = $request->barCode;
        $product->name = $request->name;
        $product->save();

        return redirect()->back()->with('success', 'Зургийг амжилттай орууллаа');
    }
}
