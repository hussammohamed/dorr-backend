@extends('layouts.app') @section('header') @endsection @section('content')

<form method="get">
<input type="file" name="files[]" multiple>
<input type="submit" value="mmm">
</form>



@endsection