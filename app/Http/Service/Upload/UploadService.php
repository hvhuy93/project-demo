<?php


namespace App\Http\Service\Upload;


class UploadService
{
    public function store($request)
    {

        if ($request->has('file')) {
            try {

                $name = $request->file('file')->getClientOriginalName();

                $pathFull = 'uploads';

                $request->file('file')->storeAs(
                    'public/' . $pathFull, $name
                );
            return '/fashion/public/storage/' . $pathFull . '/' . $name;

            } catch (\Exception $error) {
                return false;
            }
        }

    }
}
