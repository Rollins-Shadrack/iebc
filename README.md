The voting system I developed using PHP is designed to facilitate fair and secure elections. The system focuses on displaying candidates to logged-in voters based on their respective locations, ensuring that voters only see candidates from their own areas. This approach promotes localized decision-making and provides a personalized voting experience.

The user interface (UI) of the voting system is built using HTML and CSS, resulting in an intuitive and visually appealing design. The UI incorporates elements such as candidate profiles, voting buttons, and progress visualizations in the form of bar charts.

Upon logging in, voters are presented with a list of candidates specifically from their own locations. This ensures that voters can make informed decisions based on candidates representing their communities or regions. The system retrieves and displays candidate data from a MySQL database, organizing candidates based on their respective locations.

To ensure the integrity of the voting process, the system implements measures that restrict voters from casting multiple votes. Once a voter has cast their vote, the system marks them as having voted and prevents them from voting again in the same election. This prevents any form of tampering or manipulation, ensuring the fairness and accuracy of the election results.

The progress of the election is visually represented through bar charts, which provide a clear overview of the voting distribution among the candidates. These charts display the vote counts or percentages for each candidate, allowing voters and administrators to monitor the election's progress in real-time.

The PHP backend handles the authentication and authorization process, ensuring that only logged-in users can access the voting system. It also manages the interaction between the UI, the database, and the voting logic. The system securely stores user information and tracks their voting status to prevent any unauthorized access or fraudulent activities.
