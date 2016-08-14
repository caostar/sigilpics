<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Token;
use Illuminate\Http\Request;

class TokenController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tokens = Token::orderBy('id', 'desc')->paginate(10);

		return view('tokens.index', compact('tokens'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('tokens.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$token = new Token();

		$token->plataform = $request->input("plataform");
        $token->token = $request->input("token");

		$token->save();

		return redirect()->route('tokens.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$token = Token::findOrFail($id);

		return view('tokens.show', compact('token'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$token = Token::findOrFail($id);

		return view('tokens.edit', compact('token'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$token = Token::findOrFail($id);

		$token->plataform = $request->input("plataform");
        $token->token = $request->input("token");

		$token->save();

		return redirect()->route('tokens.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$token = Token::findOrFail($id);
		$token->delete();

		return redirect()->route('tokens.index')->with('message', 'Item deleted successfully.');
	}

}
