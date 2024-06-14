package clinicmanagementsystem;

import javax.swing.*;
import java.io.*;
import java.util.ArrayList;
import java.util.List;

public class DeleteUser {

    public static void deleteUser(String userId) {
        List<String> updatedLines = new ArrayList<>();
        File data = new File("C:\\JavaLab10\\ClinicManagementSystem\\patients.txt");

        try (BufferedReader reader = new BufferedReader(new FileReader(data))) {
            String line;
            while ((line = reader.readLine()) != null) {
                if (line.trim().isEmpty()) continue;
                String[] parts = line.split(",");
                String id = parts[0].trim(); // assuming the first part is the user ID
                if (id.equals(userId)) {
                    continue; // Skip this line if it matches the user ID to be deleted
                }
                updatedLines.add(line);
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
            JOptionPane.showMessageDialog(null, "User deleted successfully!", "Success", JOptionPane.INFORMATION_MESSAGE);
        } catch (IOException e) {
            JOptionPane.showMessageDialog(null, "Error writing to file", "Error", JOptionPane.ERROR_MESSAGE);
        }
    }
}

