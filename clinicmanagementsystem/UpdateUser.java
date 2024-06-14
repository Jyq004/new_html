package clinicmanagementsystem;

import javax.swing.*;
import java.io.*;
import java.util.ArrayList;
import java.util.List;

public class UpdateUser {

    public static void updateUser(String userId, String newName, String newUsername, String newPassword, String newTele, String newGender, String newAge, String newEmail) {
        List<String> updatedLines = new ArrayList<>();
        File data = new File("C:\\JavaLab10\\ClinicManagementSystem\\patients.txt");

        try (BufferedReader reader = new BufferedReader(new FileReader(data))) {
            String line;
            while ((line = reader.readLine()) != null) {
                if (line.trim().isEmpty()) continue;
                String[] parts = line.split(",");
                String id = parts[0].trim(); // assuming the first part is the user ID
                if (id.equals(userId)) {
                    // Update the line with new data
                    String updatedLine = userId + "," +
                            (newName.isEmpty() ? parts[1] : newName) + "," +
                            (newUsername.isEmpty() ? parts[2] : newUsername) + "," +
                            (newPassword.isEmpty() ? parts[3] : newPassword) + "," +
                            (newTele.isEmpty() ? parts[4] : newTele) + "," +
                            (newGender.isEmpty() ? parts[5] : newGender) + "," +
                            (newAge.isEmpty() ? parts[6] : newAge) + "," +
                            (newEmail.isEmpty() ? parts[7] : newEmail) + "," +
                            parts[8]; // assuming role is the ninth part
                    updatedLines.add(updatedLine);
                } else {
                    updatedLines.add(line); // add unchanged line
                }
            }
        } catch (IOException e) {
            JOptionPane.showMessageDialog(null, "Error reading file", "Error", JOptionPane.ERROR_MESSAGE);
            return;
        }

        // Write updated data back to file
        try (BufferedWriter writer = new BufferedWriter(new FileWriter(data))) {
            for (String updatedLine : updatedLines) {
                writer.write(updatedLine);
                writer.newLine();
            }
            JOptionPane.showMessageDialog(null, "User data updated successfully!", "Success", JOptionPane.INFORMATION_MESSAGE);
        } catch (IOException e) {
            JOptionPane.showMessageDialog(null, "Error writing to file", "Error", JOptionPane.ERROR_MESSAGE);
        }
    }
}


