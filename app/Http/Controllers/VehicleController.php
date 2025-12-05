<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Mail\InquiryEmail;
use App\Mail\InquiryForm;
use App\Models\Inquiries;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use ArrayObject;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use LDAP\Result;
use Illuminate\Support\Facades\Mail;
use Livewire\Mechanisms\HandleComponents\Synthesizers\StdClassSynth;
use stdClass;

class VehicleController extends Controller
{
    public function common_data()
    {
        $allmake = Vehicle::select('make')->distinct()->get();

        $total = Vehicle::count();

        return [
            'allmake' => $allmake,
            'total' => $total,
            'count' => [
                'alfa-romeo' => Vehicle::where('make', 'alfa-romeo')->count(),
                'toyota' => Vehicle::where('make', 'toyota')->count(),
                'nissan' => Vehicle::where('make', 'nissan')->count(),
                'honda' => Vehicle::where('make', 'honda')->count(),
                'mazda' => Vehicle::where('make', 'mazda')->count(),
                'suzuki' => Vehicle::where('make', 'suzuki')->count(),
                'BMW' => Vehicle::where('make', 'BMW')->count(),
                'mercedes' => Vehicle::where('make', 'mercedes')->count(),
                'audi' => Vehicle::where('make', 'audi')->count(),
                'isuzu' => Vehicle::where('make', 'isuzu')->count(),
                'hino' => Vehicle::where('make', 'hino')->count(),
                'mitsubishi' => Vehicle::where('make', 'mitsubishi')->count(),
                'volkswagen' => Vehicle::where('make', 'volkswagen')->count(),
                'daihatsu' => Vehicle::where('make', 'daihatsu')->count(),
                'mitsuoka' => Vehicle::where('make', 'mitsuoka')->count(),
                'lexus' => Vehicle::where('make', 'lexus')->count(),
                'subaru' => Vehicle::where('make', 'subaru')->count(),

                'hatchback' => Vehicle::where('body_type', 'hatchback')->count(),
                'sedan' => Vehicle::where('body_type', 'sedan')->count(),
                'truck' => Vehicle::where('body_type', 'truck')->count(),
                'van' => Vehicle::where('body_type', 'van')->count(),
                'suv' => Vehicle::where('body_type', 'suv')->count(),
                'pickup' => Vehicle::where('body_type', 'pickup')->count(),
                'wagon' => Vehicle::where('body_type', 'wagon')->count(),
                'buses' => Vehicle::where('body_type', 'buses')->count(),
                'mini buses' => Vehicle::where('body_type', 'mini buses')->count(),
            ],
            "filteroptions" => [
                "make" => Vehicle::select('make')->distinct()->get(),
                "model" => Vehicle::select('model')->distinct()->get(),
                "year" => Vehicle::select('year')->distinct()->orderBy('year', 'ASC')->get(),
            ],
            "vehicleOfDay" => Vehicle::select('id', 'thumbnail', 'make', 'model', 'year', 'stock_id')->orderBy('id', 'desc')->limit(3)->get(),
            "country" => [
                'jamaica' => Vehicle::where('country', 'jamaica')->count(),
                'bahamas' => Vehicle::where('country', 'bahamas')->count(),
                'guyana' => Vehicle::where('country', 'guyana')->count(),
                'barbados' => Vehicle::where('country', 'barbados')->count(),
                'kenya' => Vehicle::where('country', 'kenya')->count(),
                'tanzania' => Vehicle::where('country', 'tanzania')->count(),
                'ireland' => Vehicle::where('country', 'ireland')->count(),
                'UK' => Vehicle::where('country', 'UK')->count(),
                'mauritius' => Vehicle::where('country', 'mauritius')->count(),
                'pakistan' => Vehicle::where('country', 'pakistan')->count(),
            ]
        ];
    }

    public function load_view(string $view, array $data = [])
    {
        $data = array_merge($data, $this->common_data());
        return view($view, $data);
    }

    public function index()
    {
        $queryParams = request()->except('page');
        $vehicles = DB::table('stocks')
            ->orderBy('id', 'desc')
            ->paginate(6)
            ->appends($queryParams);

        return $this->load_view('stock', [
            'vehicles' => $vehicles,
            'stylesheet' => 'stock.css',
            'totalvehicles' => Vehicle::count(),
            'msg' => Vehicle::count() == 0 && 'No Vehicles Found',
            'sidebar' => true,
            'title' => 'Japanese Used Car Exporter'
        ]);
    }

    public function limited()
    {
        $discounted = Vehicle::where('category', 'discounted')
            ->take(8)
            ->orderBy('id', 'desc')
            ->get();
        $newarival = Vehicle::where('category', 'new arrival')
            ->take(8)
            ->orderBy('id', 'desc')
            ->get();
        $commercial = Vehicle::where('category', 'commercial')
            ->take(8)
            ->orderBy('id', 'desc')
            ->get();
        $allStock = Vehicle::take(8)
            ->orderBy('id', 'desc')
            ->get();

        return $this->load_view('index', [
            'discounted' => $discounted,
            'newarival' => $newarival,
            'commercial' => $commercial,
            'allStock' => $allStock,
            'stylesheet' => 'home.css',
            'sidebar' => true,
            'title' => 'Japanese Used Car Exporter'
        ]);
    }

    public function show(int $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $inquiries = Inquiries::all();
        $ip = false;

        foreach ($inquiries as $inquiry) {
            if ($inquiry->stock_id == $id && $inquiry->ip == request()->ip()) {
                $ip = true;
            }
        }

        $data = [
            'vehicle' => $vehicle,
            'stylesheet' => 'vehicle-info.css',
            'sidebar' => false,
            'title' => strtoupper($vehicle["make"]) . " " . strtoupper($vehicle["model"]) . " " . strtoupper($vehicle["year"]),
            'ip' => $ip,
        ];

        if ($ip) {
            $data['msg'] = 'Only One Entry Per Vehicle Is Available.';
        }

        return $this->load_view('vehicle-info', $data);
    }

    public function filter(Request $request)
    {
        $queryParams = request()->except('page');

        $make = $request->input('make');
        $model = $request->input('model');
        $stock = $request->input('stock');

        $category = $request->input('category');
        $fueltype = $request->input('fueltype');
        $transmission = $request->input('transmission');
        $yearfrom = $request->input('yearfrom');
        $yearto = $request->input('yearto');

        $query = Vehicle::query();

        if ($make) {
            $query->where('make', $make);
        }
        if ($model) {
            $query->where('model', $model);
        }
        if ($stock) {
            $query->where('stock_id', $stock);
        }
        if ($category) {
            $query->where('category', $category);
        }
        if ($fueltype) {
            $query->where('fuel', $fueltype);
        }
        if ($transmission) {
            $query->where('transmission', $transmission);
        }
        if ($yearfrom) {
            $query->where('year', '>=', $yearfrom);
        }
        if ($yearto) {
            $query->where('year', '<=', $yearto);
        }

        $totalcount = $query->count();

        $vehicles = $query->orderBy('id', 'desc')
            ->paginate(8)
            ->appends($queryParams);

        return $this->load_view('stock', [
            'title' => 'Filter Results',
            'totalvehicles' => $totalcount,
            'msg' => $totalcount == 0 ?? 'No Vehicles Found',
            'stylesheet' => 'stock.css',
            'sidebar' => true,
            'vehicles' => $vehicles
        ]);
    }

    public function search(Request $request)
    {
        $query = Vehicle::query();

        $search = $request->input('search');
        $searchArrayConvertable = explode(' ', $search);

        $count = count($searchArrayConvertable);

        if ($count == 1) {
            $vehicles = $query->where('make', $search)->orWhere('model', $search)->orWhere('year', $search)->paginate(8);
        } elseif ($count > 1) {
            $allVehicles = Vehicle::all();
            $compactArray = array();

            foreach ($allVehicles as $vehicle) {
                $compactLetter = trim($vehicle->make) . ' ' . trim($vehicle->model) . ' ' . trim($vehicle->year);
                $compactArray[$vehicle['stock_id']] = $compactLetter;
            }

            $similarVehicles = [];

            foreach ($compactArray as $stockId => $vehicleName) {
                if (stripos($vehicleName, $search) !== false) {
                    $similarVehicles[] = $stockId;
                }
            }

            $vehicles = collect();

            foreach ($similarVehicles as $searchVehicles) {
                $vehicle = Vehicle::where('stock_id', $searchVehicles)->first();
                if ($vehicle) {
                    $vehicles->push($vehicle);
                }
            }
        }

        $totalcount = $vehicles->count();

        $perPage = 8;

        $currentPage = request()->get('page', 1);
        $queryParams = request()->except('page');
        $currentItems = $vehicles->slice(($currentPage - 1) * $perPage, $perPage)->values()->all();

        $paginatedVehicles = new LengthAwarePaginator(
            $currentItems,
            $vehicles->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => $queryParams, 'pageName' => 'page']
        );

        return $this->load_view('stock', [
            'title' => 'Filter Results',
            'totalvehicles' => $totalcount,
            'msg' => $totalcount == 0 ?? 'No Vehicles Found',
            'stylesheet' => 'stock.css',
            'sidebar' => true,
            'vehicles' => $paginatedVehicles
        ]);
    }

    public function filterMake(string $make)
    {
        $vehicles = Vehicle::where('make', $make)
            ->paginate(5);

        $totalVehicles = Vehicle::where('make', $make)->count();
        $msg = null;

        if ($totalVehicles == 0) {
            $msg = "No Vehicles Present";
        }
        return $this->load_view('stock', [
            'vehicles' => $vehicles,
            'msg' => $msg,
            'totalvehicles' => $totalVehicles,
            'stylesheet' => 'stock.css',
            'title' => 'Car Stock',
            'sidebar' => true
        ]);
    }

    public function filterType(string $type)
    {
        $vehicles = Vehicle::where('body_type', $type)
            ->paginate(5);

        $totalVehicles = Vehicle::where('body_type', $type)->count();
        $msg = null;

        if ($totalVehicles == 0) {
            $msg = "No Vehicles Present";
        }

        return $this->load_view('stock', [
            'vehicles' => $vehicles,
            'title' => 'Car Stock',
            'stylesheet' => 'stock.css',
            'sidebar' => true,
            'msg' => $msg,
            'totalvehicles' => $totalVehicles,
        ]);
    }

    public function filterCountry(string $country)
    {
        $vehicles = Vehicle::where('country', $country)
            ->paginate(5);

        $totalVehicles = Vehicle::where('country', $country)->count();
        $msg = null;

        if ($totalVehicles == 0) {
            $msg = "No Vehicles Present";
        }

        return $this->load_view('stock', [
            'vehicles' => $vehicles,
            'title' => 'Car Stock',
            'stylesheet' => 'stock.css',
            'sidebar' => true,
            'msg' => $msg,
            'totalvehicles' => $totalVehicles,
        ]);
    }

    public function filterCategory(string $category)
    {
        $vehicles = Vehicle::where('category', $category)
            ->paginate(5);

        $totalVehicles = Vehicle::where('category', $category)->count();
        $msg = null;

        if ($totalVehicles == 0) {
            $msg = "No Vehicles Present";
        }

        return $this->load_view('stock', [
            'vehicles' => $vehicles,
            'title' => 'Car Stock',
            'stylesheet' => 'stock.css',
            'sidebar' => true,
            'msg' => $msg,
            'totalvehicles' => $totalVehicles,
        ]);
    }

    public function sales_and_bank_details()
    {
        return $this->load_view('bank-details', [
            'title' => 'Sales and Banking Details',
            'stylesheet' => 'bank-details.css',
            'sidebar' => false
        ]);
    }

    public function shipping()
    {
        return $this->load_view('shipping', [
            'title' => 'Shipping Service',
            'sidebar' => null,
            'stylesheet' => 'shipping.css'
        ]);
    }

    public function company_profile()
    {
        return $this->load_view('company-profile', [
            'title' => 'Company Profile',
            'sidebar' => null,
            'stylesheet' => 'company-profile.css'
        ]);
    }

    public function why_choose_us()
    {
        return $this->load_view('why-choose-us', [
            'title' => 'Why Choose Us',
            'sidebar' => null,
            'stylesheet' => 'why-choose-us.css'
        ]);
    }

    public function getModels(Request $request)
    {
        $make = $request->input('make');
        $models = Vehicle::where('make', $make)->distinct()->pluck('model');
        return response()->json($models);
    }

    public function getFueltype(Request $request)
    {
        $model = $request->input('model');
        $result = [];
        $fueltype = Vehicle::where('model', $model)->pluck('fuel');
        foreach ($fueltype as $fuel) {
            if (in_array($fueltype, $fuel) == null) {
                array_push($result, $fueltype);
            }
        }
        return response()->json($result);
    }

    public function getYears(Request $request)
    {
        $model = $request->input('model');
        $result = Vehicle::where('model', $model)->orderBy('year', 'ASC')->distinct()->pluck('year');
        return response()->json($result);
    }

    public function sendMail(Request $request)
    {
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'coment' => $request->input('coment'),
        ];

        Mail::to($request->input('email'))->send(new InquiryForm($data));
    }

    public function searchFilter(Request $request)
    {
        $search = $request->input('search');

        return $this->load_view('stock', [
            'vehicles' => Vehicle::search($search)->get(),
            'stylesheet' => 'stock.css',
            'msg' => Vehicle::count() == 0 && 'No Vehicles Found',
            'sidebar' => true,
            'title' => 'Japanese Used Car Exporter'
        ]);
    }

    public function sendEmail(Request $request)
    {
        $request->validate([
            'stock_id' => 'required|string',
            'destination' => 'required|string|max:8',
            'full_name' => 'required|string|max:30',
            'email_address' => 'required|string|max:50',
            'phone_no' => 'required|string|max:15',
            'country' => 'required|string|max:8',
            'comment' => 'nullable|string',
        ]);

        Inquiries::create(
            array_merge(
                $request->only(
                    'stock_id',
                    'destination',
                    'full_name',
                    'email_address',
                    'phone_no',
                    'country',
                    'comment',
                ),
                ['ip' => request()->ip()]
            )
        );

        $data = [
            'stock_id' => $request->stock_id,
            "destination" => $request->destination,
            "full_name" => $request->full_name,
            "destination" => $request->destination,
            "email_address" => $request->email,
            "phone_no" => $request->phone_no,
            "comment" => $request->comment,
        ];

        try {
            Mail::to('squadtech2022@gmail.com')->send(new InquiryEmail($data));
            return redirect()->back()->with('success', 'Inquiry sent successfully!');
        } catch (Exception $e) {
            Log::error('Mail sending failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'There was an error sending your inquiry. Please try again.');
        }

        return redirect()->back();
    }
}
