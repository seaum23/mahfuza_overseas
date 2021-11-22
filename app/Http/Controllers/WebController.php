<?php

namespace App\Http\Controllers;
use App\Models\WebsiteContent;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 

class WebController extends Controller
{
    public function website_backend_all_content(){
        $logo = WebsiteContent::where('id',1)->first();
        $front_background_image = WebsiteContent::where('id',2)->first();
        $brand_name = WebsiteContent::where('id',3)->first();
        $packages = WebsiteContent::get()->unique('section')->skip(3);

        return view('website_front_page_backend',compact('logo','front_background_image','brand_name','packages'));
    }

    public function create_package_section(Request $request){
        $new_package_section_name = $request->get('package_section');
        $get_if_existed_already = WebsiteContent::where('section',$new_package_section_name)->value('section');
        $image = $request->file('package_section_image');

        if(!empty($get_if_existed_already)){
            return redirect()->back()->with('warning',$get_if_existed_already.' package section already existed!');
        }else{
            $passport = new WebsiteContent;
            $passport->section = $new_package_section_name;
            $passport->headline = $request->get('package_section_headline');

            if(!empty($image)){
                $image_name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = base_path('public/storage/website/');
                $image->move($destinationPath, $image_name);

            $passport->image = 'storage/website/'.$image_name;
            }
            $passport->save();

            return redirect()->back()->with('success',$new_package_section_name.' package added successfully!');
        }
    }

    public function package_section_and_all_its_packages_delete($id){

        $package_name = WebsiteContent::where('id',$id)->value('section');
        $get_all_rows_from_package_table = Package::where('package_section_id',$id)->get()->all();
        
        foreach($get_all_rows_from_package_table as $row){

            //deleting pckage image
            $image = Package::where('id',$row->id)->value('package_image');
            $Path = 'public/';
            File::delete($Path.$image);

            $passport = Package::where('id',$row->id)->first();
            $passport->delete();
        }

            //deleting package section image
            $image = WebsiteContent::where('id',$id)->value('image');
            $Path = 'public/';
            File::delete($Path.$image);

        $passport = WebsiteContent::where('id',$id)->first();
        $passport->delete();

        return redirect('website')->with('success', $package_name.' Package Section deleted successfully!');

    }

    public function package_image_headline($id){
        $package_image_headline = WebsiteContent::where('id',$id)->get()->all();
        $package_name = WebsiteContent::where('id',$id)->value('section');
        $all_packages = Package::where('package_section_id',$id)->get()->all();
        return view('website_section',compact('package_image_headline','package_name','id','all_packages'));
    }

    public function new_package_create(Request $request,$id){
        $image = $request->file('packageImage');
        $package_name = $request->get('packageName');
        $is_package_already_exist = Package::where('package_headline',$package_name)->value('id');

        if(!empty($is_package_already_exist)){
            return redirect()->back()->with('warning',$package_name.' Package existed!');
        }else{
            $passport = new Package;
            $passport->package_section_id = $id;
            $passport->package_headline = $package_name;
            $passport->package_detail = $request->get('application');
            $passport->price = $request->get('package_price');
            $passport->salary = $request->get('salary');

            if(!empty($image)){
                $image_name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = base_path('public/storage/website/');
                $image->move($destinationPath, $image_name);

            $passport->package_image = 'storage/website/'.$image_name;
            }
            $passport->save();

            $section_name = WebsiteContent::where('id',$id)->value('section');
            return redirect()->back()->with('success',$package_name.' Package Added to'.$section_name.' section successfully!');
        }
    }

    public function sectionPackageUpdate(Request $request,$id){
        $image = $request->file('sectionPackageImage_'.$id);
        $passport = Package::where('id',$id)->first();
        $passport->package_detail = $request->get('sectionPackageDetail_'.$id);
        $passport->package_headline = $request->get('sectionPackageName_'.$id);
        $passport->price = $request->get('package_price_'.$id);
        $passport->salary = $request->get('salary_'.$id);

        if(!empty($image)){
            $previous_image = Package::where('id',$id)->value('package_image');
            $Path = 'public/';
            File::delete($Path.$previous_image);

            $image_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = base_path('public/storage/website/');
            $image->move($destinationPath, $image_name);

            $passport->package_image = 'storage/website/'.$image_name;
        }
        $passport->save();

        $package_name = Package::where('id',$id)->value('package_headline');
        return redirect()->back()->with('success',$package_name.' Package updated successfully!');
    }

    public function sectionPackageDelete($id){

            $package_name = Package::where('id',$id)->value('package_headline');

            $previous_image = Package::where('id',$id)->value('package_image');
            $Path = 'public/';
            File::delete($Path.$previous_image);

            $passport = Package::where('id',$id)->first();
            $passport->delete();

            return redirect()->back()->with('success',$package_name.' Package deleted successfully!');
    }

    public function add_new_tourist_package(Request $request){
        $image = $request->file('tourist_package_image');
        $text = $request->get('tourist_package_heading');

        $image_name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = base_path('public/storage/website/');
        $image->move($destinationPath, $image_name);

        $passport = new WebsiteContent;
        $passport->section = 'Tourist Package';
        $passport->image = 'storage/website/'.$image_name;
        $passport->headline = $text;
        $passport->save();

        return redirect('website')->with('success','New Tourist Package added successfully!');
    }

    public function PackageUpdate(Request $request,$id){
        $image = $request->file('package_update_image');
        $text = $request->get('package_update_heading');

        if(!empty($image)){
        $image_name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = base_path('public/storage/website/');
        $image->move($destinationPath, $image_name);

        //delete previous image file
        $previous_image = WebsiteContent::where('id',$id)->value('image');
        $Path = 'public/';
        File::delete($Path.$previous_image);
        }

        $passport = WebsiteContent::where('id',$id)->first();
        if(!empty($image)){
        $passport->image = 'storage/website/'.$image_name;
        }
        $passport->headline = $text;
        $passport->save();

        $package_name =WebsiteContent::where('id',$id)->value('section');
        return redirect()->back()->with('success',$package_name.' image/headline updated successfully!');

    }

    public function package_delete($id){

         //delete previous image file
        $previous_image = WebsiteContent::where('id',$id)->value('image');
        $Path = 'public/';
        File::delete($Path.$previous_image);

        $passport = WebsiteContent::where('id',$id)->first();
        $passport->delete();

        return redirect('website')->with('success','Tourist Pachage deleted Successfully');
    }

    public function front_background_image_update(Request $request, $id){

        $image = $request->file('frontBackendImage');

        $image_name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = base_path('public/storage/website/');
        $image->move($destinationPath, $image_name);

        //delete previous image file
        print $previous_image = WebsiteContent::where('id',$id)->value('image');
        $Path = 'public/';
        File::delete($Path.$previous_image);

        $passport = WebsiteContent::where('id',$id)->first();
        $passport->image = 'storage/website/'.$image_name;
        $passport->save();

        return redirect('website')->with('success','Front Background Image updated successfully!');

    }

    public function logo_update(Request $request, $id){
        $image = $request->file('logo_name');

        $image_name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = base_path('public/storage/website/');
        $image->move($destinationPath, $image_name);

        //delete previous image file
        $previous_image = WebsiteContent::where('id',$id)->value('image');
        $Path = 'public/';
        File::delete($Path.$previous_image);

        $passport = WebsiteContent::where('id',$id)->first();
        $passport->image = 'storage/website/'.$image_name;
        $passport->save();

        return redirect('website')->with('success','Logo updated successfully!');
    }

    public function brand_name_update(Request $request, $id){
        $image = $request->file('brand_name');

        $image_name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = base_path('public/storage/website/');
        $image->move($destinationPath, $image_name);

        //delete previous image file
        $previous_image = WebsiteContent::where('id',$id)->value('image');
        $Path = 'public/';
        File::delete($Path.$previous_image);

        $passport = WebsiteContent::where('id',$id)->first();
        $passport->image = 'storage/website/'.$image_name;
        $passport->save();

        return redirect('website')->with('success','Brand Name updated successfully!');
    }

}