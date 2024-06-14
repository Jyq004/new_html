package clinicmanagementsystem;

import java.io.BufferedReader;
import java.io.File;
import java.io.FileReader;
import java.io.IOException;

public class GenerateID {
    
    public static String generatePatientID() {
        int maxID = 0;
        File data = new File("C:\\JavaLab10\\ClinicManagementSystem\\patients.txt");

        if (data.exists()) {
            try (BufferedReader reader = new BufferedReader(new FileReader(data))) {
                String line;
                while ((line = reader.readLine()) != null) {
                    if (line.trim().isEmpty()) continue;
                    String[] parts = line.split(",");
                    String idStr = parts[0].substring(1);
                    int id = Integer.parseInt(idStr);
                    if (id > maxID) {
                        maxID = id;
                    }
                }
            } catch (IOException e) {
                maxID = 0;
            }
        }

        return String.format("P%03d", maxID + 1);
    }

    public static String generateDoctorID() {
        int maxID = 0;
        File data = new File("C:\\JavaLab10\\ClinicManagementSystem\\patients.txt");

        if (data.exists()) {
            try (BufferedReader reader = new BufferedReader(new FileReader(data))) {
                String line;
                while ((line = reader.readLine()) != null) {
                    if (line.trim().isEmpty()) continue;
                    String[] parts = line.split(",");
                    String idStr = parts[0].substring(1);
                    int id = Integer.parseInt(idStr);
                    if (id > maxID) {
                        maxID = id;
                    }
                }
            } catch (IOException e) {
                maxID = 0;
            }
        }

        return String.format("D%03d", maxID + 1);
    }
}

