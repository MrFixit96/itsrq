   Dim fso, tf

   Set fso = CreateObject("Scripting.FileSystemObject")
   Set tf = fso.CreateTextFile("c:\testfile.txt", True)

   ' Write a line with a newline character.
   tf.WriteLine("Testing 1, 2, 3.") 

   ' Write three newline characters to the file.        
   tf.WriteBlankLines(3) 

   ' Write a line.
   tf.Write ("This is a test.") 

   tf.Close
