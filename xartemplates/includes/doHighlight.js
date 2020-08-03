function path()
{
  var args = arguments,
      result = []
      ;

  for(var i = 0; i < args.length; i++)
      result.push(args[i].replace('@', 'modules/bbcode/xartemplates/includes/'));

  return result
}



