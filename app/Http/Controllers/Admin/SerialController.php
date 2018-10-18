<?php

namespace App\Http\Controllers\Admin;

use App\Serial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class SerialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serials = Serial::paginate(30);
        return view('admin.serials', [
            'active_menu_item' => 'serials',
            'serials' => $serials,
            'serials_count' => Serial::all()->count(),
            'content_title' => 'Управление сериалами'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $serial = new Serial();

        return view('admin.serial.edit', [
            'content_title' => 'Добавление сериала',
            'serial' => $serial,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->update($request, 0);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $serial = Serial::find($id);

        return view('admin.serial.edit', [
            'content_title' => 'Редактирование сериала',
            'serial' => $serial,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $serial = Serial::find($id);

        if (!$serial) {
            $serial = new Serial();
        }

        if ($serial) {
            $serial->title_ru = $request->title_ru;
            $serial->title_original = $request->title_original;
            $serial->year_launch = $request->year_launch;
            $serial->year_last = $request->year_last;
            $serial->ended = $request->ended;
            $serial->country = $request->country;
            $serial->episode_time = $request->episode_time;
            $serial->episode_time = $request->episode_time;
            $serial->seasons = $request->seasons;
            $serial->horror = $request->horror;
            $serial->humor = $request->humor;
            $serial->drama = $request->drama;
            $serial->melodrama = $request->melodrama;
            $serial->trash = $request->trash;
            $serial->action = $request->action;
            $serial->erotic = $request->erotic;
            $serial->beauty = $request->beauty;
            $serial->concept = $request->concept;
            $serial->story = $request->story;
            $serial->fantastic = $request->fantastic;
            $serial->wow = $request->wow;
            $serial->criminal = $request->criminal;
            $serial->trailer_link = $request->trailer_link;
            $serial->description = $request->description;

            $image = $request->file('image');
            if ($image && $image->isValid()) {
                $path = public_path('img/serials');
                $old_file = false;
                if ($serial->image) {
                    $old_file = $serial->image;
                }

                $image_name = str_replace(' ', '_', strtolower($serial->title_original)).'.'.$image->extension();
                if ($moved_file = $image->move('img/serials', $image_name)) {
                    $serial->image = $moved_file->getBasename();
                    if ($old_file && $moved_file->getBasename() != $old_file) {
                        unlink($path.'/'.$old_file);
                    }
                } else {
                    Session::flash('error', 'Ошибка при загрузке картинки');
                }
            }

            $serial->save();

            Session::flash('success', 'Сериал обновлён');
        } else {
            Session::flash('error', 'беда, сериала нет в базе, и новый создать не смогли!');
        }

        return redirect()->route('admin::serials.edit', [$serial->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $serial = Serial::find($id);

        if ($serial) {
            $title = $serial->title_ru;
            $serial->delete();
            Session::flash('success', "Сериал '{$title}' удален");
        } else {
            Session::flash('error', 'Сериал не найден');
        }

        return redirect()->route('admin::serials.index');
    }
}
