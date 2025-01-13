1 - Class Diagram :

    Classes:
        - Db
            #conn
            ----------
            +construct
        - User extend db
            #
            --------
            #Sign Up
            #Log in
        - Visitor extends user
            see courses with pagination
            search for courses
            create an account
        - Student extends visitor
            see / search courses and their details
            Inscript to a course
            My courses page that have all the courses you Inscripted to
        - Enseignant extends visitor
            add courses with details (title / description / content (Vid Or Doc) / tags / category)
            Courses Management: Modify, Delete And See Inscriptions
            Access To The Statistics Page Whee you Can find The Num Of Couses you Own And The Num Of Students That Are Subsucribed To Your Courses
        - Admin extends user
            Validate The Accounts Of Enseignant Before Giving Them Their Rights 
            Use Management: Activation Suspension Or Deletion
            Content Management: Manage Courses, Categories And Tags
            Access To Global Statistics: 
                Total Num Of Courses, Filter By Category, Courses With The Most Students And Top 3 Enseignants By Num Of Students



2 - Use Case Diagram :