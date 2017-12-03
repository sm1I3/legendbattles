
// isIntegerInRange (STRING s, INTEGER a, INTEGER b)
function isIntegerInRange (s, a, b)
{   if (isEmpty(s))
     if (isIntegerInRange.arguments.length == 1) return false;
     else return (isIntegerInRange.arguments[1] == true);

  // Catch non-integer strings to avoid creating a NaN below,
  // which isn't available on JavaScript 1.0 for Windows.
  if (!isInteger(s, false)) return false;

  // Now, explicitly change the type to integer via parseInt
  // so that the comparison code below will work both on
  // JavaScript 1.2 (which typechecks in equality comparisons)
  // and JavaScript 1.1 and before (which doesn't).
  var num = parseInt (s);
  return ((num >= a) && (num <= b));
}

function isInteger (s)
{
  var i;

  if (isEmpty(s))
  if (isInteger.arguments.length == 1) return 0;
  else return (isInteger.arguments[1] == true);

  for (i = 0; i < s.length; i++)
  {
     var c = s.charAt(i);

     if (!isDigit(c)) return false;
  }

  return true;
}

function isEmpty(s)
{
  return ((s == null) || (s.length == 0))
}

function isDigit (c)
{
  return ((c >= "0") && (c <= "9"))
}


function isSignedInteger (s)
{   
    if (isEmpty(s))
        if (isSignedInteger.arguments.length == 1) return false;
        else return (isSignedInteger.arguments[1] == true);

    else {
        var startPos = 0;
        var secondArg = false;

        if (isSignedInteger.arguments.length > 1)
            secondArg = isSignedInteger.arguments[1];

        // skip leading + or -
        if ( (s.charAt(0) == "-") || (s.charAt(0) == "+") )
            startPos = 1;
        return (isInteger(s.substring(startPos, s.length), secondArg))
    }
}

function isPositiveInteger (s)
{   var secondArg = false;

   if (isPositiveInteger.arguments.length > 1)
      secondArg = isPositiveInteger.arguments[1];

   // The next line is a bit byzantine.  What it means is:
   // a) s must be a signed integer, AND
   // b) one of the following must be true:
   //    i)  s is empty and we are supposed to return true for
   //        empty strings
   //    ii) this is a positive, not negative, number

   return (isSignedInteger(s, secondArg)
      && ( (isEmpty(s) && secondArg)  || (parseInt (s) > 0) ) );
}

function isNonnegativeInteger (s)
{   var secondArg = false;

   if (isNonnegativeInteger.arguments.length > 1)
    secondArg = isNonnegativeInteger.arguments[1];

   // The next line is a bit byzantine.  What it means is:
   // a) s must be a signed integer, AND
   // b) one of the following must be true:
   //    i)  s is empty and we are supposed to return true for
   //        empty strings
   //    ii) this is a number >= 0

   return (isSignedInteger(s, secondArg)
        && ( (isEmpty(s) && secondArg)  || (parseInt (s) >= 0) ) );
}
//...Plus isSignedInteger, isInteger, isEmpty, isDigit

